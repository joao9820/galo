<?php

namespace Estrutura\Service;

use Estrutura\Helpers\Utilities;
use Estrutura\Table\AbstractEstruturaTable;
use Zend\Db\Sql\Where;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ArraySerializable;
use Estrutura\Helpers\String;

class AbstractEstruturaService {

    /**
     * @var AbstractEstruturaTable
     */
    protected $table;
    protected $config;
    protected $hydrator;
    protected static $sm;
    protected static $adapter;

    public static function setServiceManager($sm) {
        self::$sm = $sm;
    }

    /**
     * Retrieve serviceManager instance
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator() {
        return self::$sm;
    }

    public function exchangeArray($data) {

        foreach ($data as $chave => $item) {

            $metodo = 'set' . String::underscore2Camelcase($chave);

            if (property_exists($this, $chave)) {

                $this->$metodo($item);
            }
        }
    }

    public function getTable() {

        if (!$this->table) {

            $dbAdapter = $this->getAdapter();

            $tableName = $this->getTableName();

            if (class_exists($tableName)) {

                $this->table = new $tableName();
            }

            $this->hydrator = (isset($this->table) && isset($this->table->table) ) ? new \Estrutura\Table\TableEntityMapper($this->table->campos) : new ArraySerializable();
            $rowObjectPrototype = $this;

            $resultSet = new \Zend\Db\ResultSet\HydratingResultSet($this->hydrator, $rowObjectPrototype);
            $tableGateway = new TableGateway(isset($this->table->table) ? $this->table->table : '', $dbAdapter, null, $resultSet);

            $this->table->setTableGateway($tableGateway);
        }
        return $this->table;
    }

    /**
     * Transforma um array em Objeto
     * @param $d
     * @return object
     */
    function arrayToObject($arr) {
        if (is_array($arr)) {
            /*
            * Return array converted to object
            * Using __FUNCTION__ (Magic constant)
            * for recursive call
            */
            return (object) array_map(__FUNCTION__, $arr);
        }
        else {
            // Return object
            return $arr;
        }
    }

    public function toArray() {
        $classe = new \ReflectionClass($this);
        $item = [];

        foreach ($classe->getProperties() as $property) {

            if (!preg_match('/Entity/', $property->getDeclaringClass()->getName())) {
                continue;
            }

            $valor = $this->{'get' . ucfirst($property->getName())}();

            if ($valor instanceof AbstractEstruturaService) {

                $item[$property->getName()] = $valor->toArray();
            } elseif ($valor instanceof \DateTime) {

                $item[$property->getName()] = $valor->format('d/m/Y');
            } else {

                $item[$property->getName()] = $valor;
            }
        }

        return $item;
    }

    public function toArrayResult($result) {

        $aResult = [];

        foreach ($result as $value) {
            $aResult[] = $value;
        }

        return $aResult;
    }

    public function hydrate($attribute = null, $clear = true) {

        $this->getTable();
        $obj = $this;
        $arr = $this->hydrator->extract($obj);

        if ($clear) {
            $arr = array_filter($arr, function($item) {
                return $item !== null;
            });
        }

        if ($attribute) {
            if (is_string($attribute)) {
                $attribute = array($attribute);
            }
            $arrFields = array_intersect($this->table->campos, $attribute);
            $arrFields = array_keys($arrFields);
            $arrFiltrado = array();
            foreach ($arrFields as $field) {
                $arrFiltrado[$field] = array_key_exists($field, $arr) ? $arr[$field] : null;
            }
            $arr = $arrFiltrado;
        }

        return($arr);
    }

    /**
     * Retorna o nome do objeto Table
     *
     * @return type
     */
    private function getTableName() {

        $objName = str_replace('Service', 'Table', get_class($this));
        return $objName;
    }

//    public function setResultset($dados){
//        $this->exchangeArray($dados);
//    }

    public function getConfig() {
        if (!$this->config) {
            $this->config = Config::getConfig('db');
        }
        return $this->config;
    }

    public function getAdapter() {

        if (!self::$adapter) {

            self::$adapter = new \Zend\Db\Adapter\Adapter($this->getConfig());
        }
        return self::$adapter;
    }

    public function fetchAll() {
        return $this->select();
    }

    /**
     *
     * $select = new Select('nome_tabela');
     * $select->order(['nome_coluna']);
     * return $this->getTable()->getTableGateway()->selectWith($select);
     *
     * RETORNA UMA COLECAO
     * @param Select|null $select
     * @return mixed
     */
    public function fetchAllCustom(Select $select = null, $arColunasOrdenacao = []) {
        if (null === $select)
            $select = new Select();
        $select->from($this->table);
        $select->order($arColunasOrdenacao);
        $resultSet = $this->selectWith($select);
        $resultSet->buffer();
        return $resultSet;
    }

    /**
     * @author Alysson Vicuña de Oliveira
     * @param $arrayFiltro array('coluna_tabela' => 'valor')
     * @return array Registros retortnados do Banco de Dados
     */
    public function fetchAllById($arrayFiltro)
    {
        $arrayResults = $this->select($arrayFiltro)->toArray();
        return $arrayResults;
    }

    /**
     * @author Alysson Vicuña de Oliveira
     * @param $arrayFiltro array('coluna_tabela' => 'valor')
     * @return array Registros retortnados do Banco de Dados
     */
    public function fetchAllByArrayAtributo($arrayFiltro)
    {
        $arrayResults = $this->select($arrayFiltro)->toArray();
        return $arrayResults;
    }

    /**
     * Filtra os registros que atendam aos filtros passados por array
     * @author Alysson Vicuña de Oliveira
     * @param $arrayEhere array('coluna_tabela' => 'valor')
     * @return object Registros retortnados do Banco de Dados em Forma de Objeto
     */
    public function select($where = null) {
        return $this->getTable()->select($where);
    }

    /**
     * @return object
     */
    public function filtrarObjeto() {
        $where = $this->hydrate();
        $wTratado = new Where();

        foreach ($where as $chave => $valor) {
            if ($chave == 'NOME') {
                $wTratado->like($chave, '%' . $valor . '%');
            } else {
                $wTratado->equalTo($chave, $valor);
            }
        }

        $select = $this->select($wTratado);
        if (is_object($select)) {

            $select->buffer();
        }
        return $select;
    }

    /**
     * @author Alysson Vicuña de Oliveira
     * @return \Estrutura\Table\id
     */
    public function inserir_nao_identity() {
        $dados = $this->hydrate();
        $dados = Utilities::replaceEmptyPorNuloInArray($dados);

        return $this->getTable()->inserir_nao_identity($dados);
    }

    public function salvar() {
        $this->preSave();
        $dados = $this->hydrate();
        $where = null;

        if ($this->getId()) {
            if (!$field = $this->fieldName('id')) {
                $field = $this->fieldName('Id');
            }

            $where = [$field => $this->getId()];
        }

        $result = $this->getTable()->salvar($dados, $where);
        if (is_string($result)) {
            $this->setId($result);
        }
        $this->posSave($result);

        return $result;
    }

    public function preSave() {

    }

    public function posSave() {

    }

    public function preDelete() {

    }

    public function posDelete() {

    }

    public function excluir() {
        $arr = $this->hydrate();
        $this->preDelete();
        $this->getTable()->delete($arr);
        $this->posDelete();
    }

    public function load() {
        $arr = $this->hydrate(['id']);
        $dados = $this->select($arr)->current();

        if ($dados) {
            $this->exchangeArray($dados->toArray());
            return $this;
        }

        return null;
    }

    public function buscar($id) {
        $this->setId($id);
        return $this->filtrarObjeto()->current();
    }

    public function fieldName($attribute) {
        return (($chave = array_search($attribute, $this->table->campos)) !== false) ? $chave : null;
    }

    /**
     * Overloading.
     *
     * Esse método não é chamado diretamente. Ele irá interceptar chamadas
     * a métodos não definidos na classe. Se for um set* ou get* irá realizar
     * as ações necessárias sobre as propriedades da classe.
     *
     * @param string $metodo O nome do método quer será chamado
     * @param array $parametros Parâmetros que serão passados aos métodos
     * @return mixed
     */
    public function __call($metodo, $parametros) {
        $prefixo = substr($metodo, 0, 3);
        $var = String::camelcase2underscore(strtolower(substr(str_replace($prefixo, '', $metodo), 0, 1)) . substr($metodo, 4, strlen($metodo)));

        if (property_exists($this, $var)) {

            // se for set*, "seta" um valor para a propriedade
            if (strcasecmp($prefixo, 'set') == 0) {

                $this->$var = $parametros[0];
                // se for get*, retorna o valor da propriedade
            } elseif (strcasecmp($prefixo, 'get') == 0) {

                return $this->$var;
            }
        } else {

            echo 'Propriedade ' . $var . ' não existe.';
        }
    }

}

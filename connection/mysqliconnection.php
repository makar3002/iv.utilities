<?php
namespace Connection;

class MysqliConnection implements IConnection
{
    public const TRANSACTION_OPEN = 0;
    public const TRANSAACTION_CLOSED = 1;

    /** @var \mysqli $connection */
    protected $connection;
    protected $transactionState;

    /**
     * Устанавливает соединение с БД.
     *
     * @param ConnectionConfiguration $config
     * @throws SqlConnectionException
     */
    public function connect(ConnectionConfiguration $config)
    {
        $this->connection = new \mysqli(
            $config->getHost(),
            $config->getUsername(),
            $config->getPassword(),
            $config->getDatabaseName()
        );

        if ($this->connection->connect_errno) {
            throw new SqlConnectionException($this->connection->connect_error, $this->connection->errno, $this->connection);
        }
    }

    /**
     * Закрывает соединение с БД.
     *
     * @return void
     */
    public function close()
    {
        if ($this->connection !== null) {
            $this->connection->close();
        }
    }

    /**
     * Выполняет запрос к БД.
     *
     * @see \mysqli::query()
     *
     * @param $query
     * @return bool|\mysqli_result
     *
     * @throws SqlQueryException
     */
    public function query($query)
    {
        if ($this->connection === null) {
            throw new SqlQueryException('No connection to database.');
        }

        $result = $this->connection->query($query);

        if ($this->connection->errno) {
            throw new SqlQueryException($this->connection->error, $this->connection->error);
        }

        return $result;
    }

    /**
     * Экранирует значение перед записью в базу.
     *
     * @see \mysqli::real_escape_string()
     *
     * @param $value
     * @return string
     *
     * @throws SqlQueryException
     */
    public function prepare($value)
    {
        if ($this->connection === null) {
            throw new SqlQueryException('No connection to database.');
        }

        $escaped = $this->connection->real_escape_string($value);

        if ($this->connection->errno) {
            throw new SqlQueryException($this->connection->error, $this->connection->error);
        }

        return $escaped;
    }

    /**
     * Предназначен для экранирования названий столбцов/таблиц/базы.
     *
     * @param string $identifier
     * @return string
     */
    public function quote($identifier)
    {
        $identifier = trim($identifier, '`');
        return '`' . $identifier . '`';
    }

    /**
     * Открывает транзакцию.
     *
     * @return bool
     * @throws SqlQueryException
     */
    public function startTransaction()
    {
        return $this->query('START TRANSACTION');
    }

    /**
     * Подтверждает транзакцию.
     *
     * @return bool
     * @throws SqlQueryException
     */
    public function commitTransaction()
    {
        return $this->query('COMMIT');
    }

    /**
     * Откатывает транзакцию.
     *
     * @return bool
     *
     * @throws SqlQueryException
     */
    public function rollbackTransaction()
    {
        return $this->query('ROLLBACK');
    }
}
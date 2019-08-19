<?php

/**
 * Class DB
 *
 * 数据库访问类
 *
 * 提供一切数据库底层函数
 *
 */
class DB
{
	protected $pdo;

    public function __construct($config = []){
        try{
            $config = $config ? $config : C('database');
            $this->pdo = new PDO(
                $config['connection'].
                ';dbname='.$config['database'].
                ';charset='.$config['charset'],
                $config['username'],
                $config['password'],
                $config['options']
            );
        }catch(PDOException $e){
            dd($e->getMessage());
        }
    }

    //原生态的sql 执行函数， 可以执行个人定制sql语句
    public function query($query, $parameters = [], $intoClass = 'stdClass')
    {
        $statement = $this->pdo->prepare($query);

        $result = $statement->execute($parameters);

        if(!preg_match('/^select .+/i', $query)) {
            return $result;
        }

        $results = $statement->fetchAll(PDO::FETCH_CLASS, $intoClass);

        return $results;
    }


    //执行条件查询
    public function find($query, $parameters = [], $intoClass = 'stdClass')
	{
		$statement = $this->pdo->prepare($query);

		$statement->execute($parameters);

        $results = $statement->fetchAll(
            PDO::FETCH_CLASS,
            $intoClass
        );

        if(count($results) === 1){
            return $results[0];
        }else{
            return false;
        }
	}

    //提供添加操作，往对应表添加数据
	public function save($table, $parameters)
	{
		$sql = sprintf(
			'insert into %s (%s) values (%s)',
			$table,
			implode(', ', array_keys($parameters)),
			':' . implode(', :', array_keys($parameters))
		);

		try{
			$statement = $this->pdo->prepare($sql);

			if($statement->execute($parameters)) {

				$parameters = [
				    $this->pdo->lastInsertId()
				];

				return $this->find(
					"select * from {$table} where id = ?",
					$parameters
				);

			}else{
				return false;
			}

		}catch (PDOException $e){
			dd($e->getMessage());
		}
	}
}
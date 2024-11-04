<?php

namespace App\models;

use App\config\Db;

class Model extends Db
{
    protected $table;
    private $db;

    /**
     * Creates a new entry in the database.
     *
     * Constructs an SQL INSERT statement using the current object's properties
     * and inserts the data into the corresponding database table.
     *
     * @return PDOStatement|false Returns a PDOStatement object on success, or false on failure.
     */
    public function create()
    {
        $champs = [];
        $inter = [];
        $valeurs = [];

        foreach ($this as $champ => $valeur) {
            if ($valeur !== null && $champ != 'db' && $champ != 'table') {
                $champs[] = $champ;
                $inter[] = "?";
                $valeurs[] = $valeur;
            }
        }

        $listChamps = implode(', ', $champs);
        $listeInter = implode(', ', $inter);
        $sql = 'INSERT INTO ' . $this->table . ' (' . $listChamps . ') VALUES (' . $listeInter . ')';

        return $this->req($sql, $valeurs);
    }

    /**
     * Retrieves all entries from the database table.
     *
     * Executes a SELECT statement to get all rows from the table.
     *
     * @return array|false Returns an array of all rows as associative arrays, or false on failure.
     */
    public function selectAll()
    {
        $query = $this->req('SELECT * FROM ' . $this->table);
        return $query->fetchAll();
    }

    /**
     * Retrieves an entry by its ID.
     *
     * Executes a SELECT statement to find a specific row by its ID.
     *
     * @param integer $id The ID of the entry to retrieve.
     * @return array|false Returns an associative array representing the row, or false on failure.
     */
    public function select(int $id)
    {
        return $this->req("SELECT * FROM " . $this->table . " WHERE id = ?", [$id])->fetch();
    }

    /**
     * Updates an existing entry in the database by its ID.
     *
     * Constructs an SQL UPDATE statement using the current object's properties
     * and updates the corresponding row in the table.
     *
     * @param integer $id The ID of the entry to update.
     * @return PDOStatement|false Returns a PDOStatement object on success, or false on failure.
     */
    public function update(int $id)
    {
        $champs = [];
        $valeurs = [];

        foreach ($this as $champ => $valeur) {
            if ($valeur !== null && $champ != 'db' && $champ != 'table') {
                $champs[] = "$champ = ?";
                $valeurs[] = $valeur;
            }
        }
        $valeurs[] = $id;
        $listChamps = implode(', ', $champs);

        return $this->req('UPDATE ' . $this->table . ' SET ' . $listChamps . ' WHERE id = ?', $valeurs);
    }

    /**
     * Deletes an entry from the database by its ID.
     *
     * Executes a DELETE statement to remove a specific row by its ID.
     *
     * @param integer $id The ID of the entry to delete.
     * @return PDOStatement|false Returns a PDOStatement object on success, or false on failure.
     */
    public function delete(int $id)
    {
        return $this->req('DELETE FROM ' . $this->table . ' WHERE id = ?', [$id]);
    }

    /**
     * Hydrates the current object with data.
     *
     * Takes an associative array of data and uses setter methods to populate
     * the object's properties.
     *
     * @param array $data The data to hydrate the object with.
     * @return self Returns the current instance of the object for method chaining.
     */
    public function hydrate($data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }

        return $this;
    }

    /**
     * Executes a SQL query with optional parameters.
     *
     * Prepares and executes a SQL query using the provided parameters.
     *
     * @param string $sql The SQL statement to execute.
     * @param array|null $attributes Optional attributes for parameter binding.
     * @return PDOStatement|false Returns a PDOStatement on success or false on failure.
     */
    public function req(string $sql, array $attributes = null)
    {
        $this->db = Db::getInstance();

        if ($attributes !== null) {
            $query = $this->db->prepare($sql);
            $query->execute($attributes);
            return $query;
        } else {
            return $this->db->query($sql);
        }
    }
}
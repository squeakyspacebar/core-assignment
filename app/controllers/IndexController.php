<?php

use Phalcon\Mvc\Controller;
use Phalcon\Db;
use Phalcon\Db\Exception;
use Phalcon\Db\Adapter\Pdo\Sqlite;

class IndexController extends Controller {
    public function indexAction() {
        try {
            # Connect to DB.
            $connection = new Sqlite(
                [
                    'dbname' => BASE_PATH . '/database.sqlite3',
                ]
            );

            # Query for news articles.
            $results = $connection->query(
                'SELECT * FROM article LIMIT 5'
            );

            # Fetch results into associative array.
            $results->setFetchMode(Db::FETCH_ASSOC);

            # Pass query results to be accessible in view.
            $this->view->setVar('results', $results->fetchAll());
        } catch (Exception $e) {
            echo $e->getMessage(), PHP_EOL;
        }

        # Declare CSS assets.
        $headerCollection = $this->assets->collection('header');
        # Remote CSS assets.
        $headerCollection->addCss('//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css', false);

        # Declare JS assets.
        $footerCollection = $this->assets->collection('footer');
        # Remote JS assets.
        $footerCollection->addJs('//code.jquery.com/jquery-3.2.1.slim.min.js', false);
        $footerCollection->addJs('//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js', false);
        # Local JS assets.
	$footerCollection->addJs('js/script.js');

        # Add JS minification filter.
	#$footerCollection->addFilter(
        #    new Phalcon\Assets\Filters\Jsmin()
        #);
    }
}

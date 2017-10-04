I ended up going for Option 2 of the given exercises.

## Approach

Although this could have been performed quickly as a strictly hacked together solution in raw PHP, I ended up selecting a framework to keep things structured and sane. I selected Phalcon as I found it to be straightforward and clean to use. Since this is a very simple application, SQLite seemed perfect for the database.

I created a basic schema and collected some dummy data into the `db.sql` file, then initialized a database from the resulting file. I then created a very simple index controller and view to handle everything for this specific task. I felt that using a model would be overkill, so I opted to query the database directly using PDO. The index controller's only action exists simply to grab the articles from the database and shunt them over to the view.

The table that displays the data uses the jQuery DataTables plugin for behavior and styling.

## Using the Application

Using the provided deployment solution to test the application requires the following:

- [Virtualbox](https://www.virtualbox.org/wiki/Downloads)
- [Vagrant](https://www.vagrantup.com/docs/installation/)
- [Ansible](http://docs.ansible.com/ansible/latest/intro_installation.html#installing-the-control-machine)

Since I am a proponent of documentation through configuration as code, I spent some time trying to ease deployment by having Vagrant create a Virtualbox instance to serve the application and Ansible to configure the machine. The application can be deployed simply by running the command `vagrant up` in the root directory of the project and then using a browser to navigate to `localhost:8080` when the box has completed setup (make sure nothing else is running on port `8080`, or you can reconfigure the port being used by editing the `Vagrantfile`).

If you wish to deploy the application yourself, the instructions for installing Phalcon are [here](https://docs.phalconphp.com/en/3.2/installation), and the instructions for configuring the application with web servers can be found [here](https://docs.phalconphp.com/en/3.2/webserver-setup). One thing to remember if you're taking this path is that the SQLite database needs to be created. You should be able to simply run `sqlite3 database.sqlite3 << db.sql` in the root directory of the project to accomplish this.

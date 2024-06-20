### Launch the Web App

To start the web app, open your console in project folder and run:
```bash
docker-compose up -d
```

### Database Management

#### Exporting the Database
To export the current state of the database:

```bash
docker exec -it src-db-1 mysqldump -uuser -ppassword forum > forum_db.sql
```

## If the database is broken, follow these steps to reset it:

#### Dropping the Database

```bash
docker exec -it src-db-1 mysql -uuser -ppassword -e "DROP DATABASE forum"
```

#### Creating the 'forum' Database

1. **Connect to MySQL Server:**

    ```bash
    docker exec -it src-db-1 mysql -uuser -ppassword
    ```

2. **Create the 'forum' Database:**

    ```sql
    CREATE DATABASE forum;
    ```

3. **Exit MySQL Server:**

    ```sql
    exit
    ```

4. **Execute SQL Commands from `forum_db.sql`:**

    ```bash
    Get-Content C:/www/PHP_FORUM/src/database-storage/forum_db.sql | docker exec -i src-db-1 mysql -uuser -ppassword forum
    ```

This command reads the content of the `forum_db.sql` file and pipes it to the MySQL server within the Docker container.

### PHP with MySQL: Forum with Admin Panel

This project showcases a dynamic forum platform with a robust admin panel, leveraging PHP, MySQL, Bootstrap, and PDO.

## Project Overview

- **Authentication System**: Secure and user-friendly authentication.
- **Password Security**: Secure hashing and dehashing techniques.
- **Efficient Database Interactions**: Using PDO for secure database access.
- **Comprehensive Topic Management**: Versatile topic creation and management.
- **Interactive Replies**: Responsive system for posting, editing, and deleting replies.
- **Structured Category Organization**: Effective topic classification.
- **Web Development Insights**: Best practices for efficient coding.
- **Empowering Admin Panel**: Tools for seamless forum management.
- **Data Validation**: Good techniques for security and integrity.
- **User Profile Personalization**: Enhancing user engagement and customization.

## Technologies Utilized

- **PHP (Hypertext Preprocessor)**: Backend functionality including authentication and data manipulation.
- **MySQL**: Relational database management for user accounts, topics, replies, and categories.
- **Bootstrap**: Front-end framework for responsive, visually appealing interfaces.
- **PDO (PHP Data Objects)**: Secure and efficient database communication.

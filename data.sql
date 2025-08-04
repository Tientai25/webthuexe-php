CREATE DATABASE bike_store;
USE bike_store;

CREATE TABLE bicycles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    description TEXT,
    price DECIMAL(10, 2),
    img VARCHAR(255),
    quantity INT
);

INSERT INTO bicycles (id, title, description, price, img, quantity) VALUES
(1, 'MountainBike', 'Lorem ipsum dolor sit amet consectetur. Repellendus non, dicta libero incidunt neque voluptatem!', 10000000.00, 'xe-dap-the-thao-cao-cap-1-1.png', 8),
(3, 'Road Bike', 'Lorem ipsum dolor sit amet consectetur. Repellendus non, dicta libero incidunt neque voluptatem!', 10000000.00, 'xe-dap-the-thao-cao-cap-3-1.png', 8),
(4, 'City Bike', 'Lorem ipsum dolor sit amet consectetur. Repellendus non, dicta libero incidunt neque voluptatem!', 10000000.00, 'xe-dap-the-thao-cao-cap-4-1.png', 5),
(5, 'MountainBike', 'Lorem ipsum dolor sit amet consectetur. Repellendus non, dicta libero incidunt neque voluptatem!', 10000000.00, 'xe-dap-the-thao-cao-cap-5-1.png', 10),
(6, 'Road Bike', 'Lorem ipsum dolor sit amet consectetur. Repellendus non, dicta libero incidunt neque voluptatem!', 10000000.00, 'xe-dap-the-thao-cao-cap-6-1.png', 10),
(7, 'City Bike', 'Lorem ipsum dolor sit amet consectetur. Repellendus non, dicta libero incidunt neque voluptatem!', 10000000.00, 'xe-dap-the-thao-cao-cap-7-1.png', 10),
(8, 'Sport Bike', 'Lorem ipsum dolor sit amet consectetur. Repellendus non, dicta libero incidunt neque voluptatem!', 10000000.00, 'xe-dap-the-thao-cao-cap-8-1.png', 10),
(14, 'City Bike', 'Lorem ipsum dolor sit amet consectetur. Repellendus non, dicta libero incidunt neque voluptatem!', 25000000.00, 'xe-dap-the-thao-cao-cap-2-1.png', 9),
(16, 'City Bike', 'Lorem ipsum dolor sit amet consectetur. Repellendus non, dicta libero incidunt neque voluptatem!', 9000000.00, 'newbike.jpg', 10);


CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    cfpassword VARCHAR(255),
    role VARCHAR(50) DEFAULT 'user'
);


INSERT INTO users (id, username, email, password, cfpassword, role) VALUES
(1, 'admin', 'admin@gmail.com', 'admin123', 'admin123', 'admin'),
(2, 'yinghao', 'yinghao@gmail.com', 'yinghao32', 'yinghao32', 'user'),
(3, 'xiaohao', 'xiaohao@gmail.com', 'xiaohao32', 'xiaohao32', 'user'),
(6, 'user1', 'user1@gmail.com', '123456', '123456', 'user');


CREATE TABLE orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NULL,
    customer_name VARCHAR(255) NOT NULL,
    customer_phone VARCHAR(20) NOT NULL,
    customer_address TEXT NOT NULL,
    order_date DATETIME NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE order_details (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    bike_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (bike_id) REFERENCES bicycles(id)
);

CREATE TABLE contacts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at DATETIME NOT NULL
);
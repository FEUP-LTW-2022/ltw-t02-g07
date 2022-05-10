
DROP TABLE IF EXISTS Order_list;
DROP TABLE IF EXISTS Order_row;
DROP TABLE IF EXISTS Driver;
DROP TABLE IF EXISTS Favorite;
DROP TABLE IF EXISTS Review;
DROP TABLE IF EXISTS Dish;
DROP TABLE IF EXISTS Restaurant;
DROP TABLE IF EXISTS Owner;
DROP TABLE IF EXISTS User;


PRAGMA foreign_keys=ON;


CREATE TABLE User
(
    UserId INTEGER NOT NULL,
    Name NVARCHAR(30) NOT NULL,
    Password NVARCHAR(30) NOT NULL,
    Address NVARCHAR(30),
    PhoneNumber NVARCHAR(20),
    CONSTRAINT PK_User PRIMARY KEY (UserId)
);

CREATE TABLE Owner
(
    OwnerId INTEGER NOT NULL,
    Name NVARCHAR(30) NOT NULL,
    Password NVARCHAR(30) NOT NULL,
    Address NVARCHAR(30),
    PhoneNumber NVARCHAR(20), 
    CONSTRAINT PK_Owner PRIMARY KEY (OwnerId)
);

CREATE TABLE Restaurant
(
    RestaurantId INTEGER NOT NULL,
    Name NVARCHAR(30) NOT NULL,
    Address NVARCHAR(30) NOT NULL,
    Category NVARCHAR(20) NOT NULL,
    Id_owner INTEGER,
    CONSTRAINT PK_Restaurant PRIMARY KEY (RestaurantId),
    FOREIGN KEY(Id_owner) REFERENCES Owner (OwnerId)
);
CREATE TABLE Dish
(
    DishId INTEGER NOT NULL,
    Name NVARCHAR(30) NOT NULL,
    Description NVARCHAR(30),
    Price REAL,
    Category NVARCHAR(30),
    Picture NVARCHAR(200),
    Promotion REAL DEFAULT 1.0,
    Id_restaurant INTEGER,
    CONSTRAINT PK_Dish PRIMARY KEY (DishId),
    FOREIGN KEY(Id_restaurant) REFERENCES Restaurant (RestaurantId)
);

CREATE TABLE Review
(
    ReviewId INTEGER NOT NULL,
    Score REAL NOT NULL,
    Description NVARCHAR(100),
    Picture NVARCHAR(200),
    Id_restaurant INTEGER,
    Id_user INTEGER,
    CONSTRAINT PK_Review PRIMARY KEY (ReviewId),
    FOREIGN KEY(Id_restaurant) REFERENCES Restaurant (RestaurantId),
    FOREIGN KEY(Id_user) REFERENCES User(UserId)
);

CREATE TABLE Favorite
(
    Id_user INTEGER NOT NULL,
    Id_dish INTEGER NOT NULL,
    CONSTRAINT PK_Favorite PRIMARY KEY (Id_user,Id_dish),
    FOREIGN KEY(Id_user) REFERENCES User (UserId),
    FOREIGN KEY(Id_dish) REFERENCES Dish (DishId)
);

CREATE TABLE Driver
(
    DriverId INTEGER,
    Name NVARCHAR(30) NOT NULL,
    Password NVARCHAR(30) NOT NULL,
    PhoneNumber NVARCHAR(20), 
    CONSTRAINT PK_Driver PRIMARY KEY (DriverId)
);

CREATE TABLE Order_row
(
    OrderId INTEGER NOT NULL,
    Id_user INTEGER NOT NULL,
    Id_driver INTEGER NOT NULL,
    State_order TEXT CHECK(State_order IN ("received","preparing","ready","delivered")),
    CONSTRAINT PK_Order PRIMARY KEY (OrderId),
    FOREIGN KEY(Id_user) REFERENCES User (UserId),
    FOREIGN KEY(Id_driver) REFERENCES Driver (DriverId)
);

CREATE TABLE Order_list
(
    Id_order INTEGER,
    Id_dish INTEGER,
    CONSTRAINT PK_OrderList PRIMARY KEY(Id_order,Id_dish),
    FOREIGN KEY(Id_order) REFERENCES Order_row (OrderId),
    FOREIGN KEY(Id_dish) REFERENCES Dish (DishId)
);


INSERT INTO Owner (OwnerId, Name, Password, Address, PhoneNumber) VALUES (1, 'Owner1', 'Password1', 'House1', '1234');
INSERT INTO User (UserId, Name, Password, Address, PhoneNumber) VALUES (1, 'User1', 'Password2', 'House2', '5678');
INSERT INTO Driver (DriverId, Name, Password, PhoneNumber) VALUES (1, 'Driver1', 'Password3', '9101');
INSERT INTO Restaurant (RestaurantId, Name, Address, Category, Id_owner) VALUES (1, 'Restaurant1', 'House2', 'Category1', 1);
INSERT INTO Dish (DishId, Name, Description, Price, Category, Picture, Promotion, Id_restaurant) VALUES (1, 'Dish1', 'Description1', 1, 'Category1', 'Picture1.png', 0, 1);
INSERT INTO Review (ReviewId, Score, Description, Picture, Id_restaurant, Id_user) VALUES (1, 5, 'Description2', 'Picture2.png', 1, 1);
INSERT INTO Favorite (Id_user, Id_dish) VALUES (1, 1);
INSERT INTO Order_row (Orderid, State_order, Id_user, Id_driver) VALUES (1, 'delivered', 1, 1);
INSERT INTO Order_list (Id_order, Id_dish) VALUES (1, 1)


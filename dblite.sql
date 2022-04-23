
DROP TABLE IF EXISTS Order_list;
DROP TABLE IF EXISTS Order_row;
DROP TABLE IF EXISTS Driver;
DROP TABLE IF EXISTS Favorite;
DROP TABLE IF EXISTS Review;
DROP TABLE IF EXISTS Dish;
DROP TABLE IF EXISTS Restaurant;
DROP TABLE IF EXISTS Owner;
DROP TABLE IF EXISTS User;


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
    FOREIGN KEY(OwnerId) REFERENCES User (UserId)
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
    Id_restaurant INTEGER,
    Promotion REAL DEFAULT 1.0,
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
    FOREIGN KEY(DriverId) REFERENCES User(UserId)  
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
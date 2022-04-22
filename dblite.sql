PRAGMA foreign_keys = ON;

CREATE TABLE "user"
(
    [Id] INTEGER PRIMARY KEY AUTOINCREMENT,
    [Name] NVARCHAR(30) NOT NULL,
    [Password] NVARCHAR() NOT NULL,
    [Address] NVARCHAR(30),
    [PhoneNumber] NVARCHAR(20)
);

CREATE TABLE "owner"
(
    [Id_owner] INTEGER NOT NULL, 
    FOREIGN KEY([Id_owner]) REFERENCES "user" ([Id])
);

CREATE TABLE "restaurant"
(
    [Id] INTEGER PRIMARY KEY AUTOINCREMENT,
    [Name] NVARCHAR() NOT NULL,
    [Address] NVARCHAR(30) NOT NULL,
    [Category] NVARCHAR(20) NOT NULL,
    [Id_owner] INTEGER,
    FOREIGN KEY([Id_owner]) REFERENCES "owner" ([Id_owner])
);
CREATE TABLE "dish"
(
    [Id] INTEGER PRIMARY KEY AUTOINCREMENT,
    [Name] NVARCHAR() NOT NULL,
    [Description] NVARCHAR(),
    [Price] REAL,
    [Category] NVARCHAR(),
    [Picture] NVARCHAR(),
    [Id_restaurant] INTEGER,
    [Promotion] REAL DEFAULT 1.0,
    FOREIGN KEY([Id_restaurant]) REFERENCES "restaurant" ([Id])
);

CREATE TABLE "review"
(
    [Id] INTEGER PRIMARY KEY AUTOINCREMENT,
    [Score] REAL NOT NULL,
    [Description] NVARCHAR(),
    [Picture] NVARCHAR(),
    [Id_restaurant] INTEGER,
    [Id_user] INTEGER,
    FOREIGN KEY([Id_restaurant]) REFERENCES "restaurant" ([Id]),
    FOREIGN KEY([Id_user]) REFERENCES "user"([Id])
);

CREATE TABLE "favorite"
(
    [Id_user] INTEGER,
    [Id_dish] INTEGER,
    PRIMARY KEY(Id_user,Id_dish),
    FOREIGN KEY([Id_user]) REFERENCES "user" ([Id]),
    FOREIGN KEY([Id_dish]) REFERENCES "dish" ([Id])
);

CREATE TABLE "driver"
(
    [Id_driver] INTEGER,
    FOREIGN KEY([Id_driver]) REFERENCES "user"([Id])  
);

CREATE TABLE "order"
(
    [Id] INTEGER PRIMARY KEY AUTOINCREMENT,
    [Id_user] INTEGER,
    [Id_driver] INTEGER,
    [State_order] NVARCHAR NOT NULL CHECK(State_order = "received"
                                         OR State_order = "preparing"
                                         OR State_order = "ready"
                                         OR State_order = "delivered"),
    FOREIGN KEY([Id_user]) REFERENCES "user" ([Id]),
    FOREIGN KEY([Id_driver]) REFERENCES "driver" ([Id_driver])
);

CREATE TABLE "order_list"
(
    [Id_order] INTEGER,
    [Id_dish] INTEGER,
    PRIMARY KEY(Id_order,Id_dish),
    FOREIGN KEY([Id_order]) REFERENCES "order" ([Id]),
    FOREIGN KEY([Id_dish]) REFERENCES "dish" ([Id])
);



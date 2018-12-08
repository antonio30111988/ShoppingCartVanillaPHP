CREATE TABLE cart_items(
  id         INT PRIMARY KEY,
  sku        CHAR(20) UNIQUE NOT NULL,
  name       CHAR(50),
  quantity   INT NOT NULL,
  price      REAL
);

CREATE TABLE inventory(
  id       INT PRIMARY KEY,
  sku      CHAR(20) NOT NULL,
  name     CHAR(50),
  quantity INT NOT NULL,
  price    REAL
);


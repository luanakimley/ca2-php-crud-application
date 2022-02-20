DROP DATABASE IF EXISTS expense_tracker;
CREATE DATABASE IF NOT EXISTS expense_tracker;
USE expense_tracker;

DROP TABLE IF EXISTS `categories`;
DROP TABLE IF EXISTS `expenses`;

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryID` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(255) NOT NULL,
  `parentID` int(11), -- To detect if category is Main/Sub. How? "Null" if Main, "main category" id if child
  `icon` varchar(50),
  PRIMARY KEY (categoryID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryID`, `categoryName`, `parentID`, `icon`) VALUES
(NULL, 'Food & Beverages', NULL, 'fa-solid fa-martini-glass-citrus'),
(NULL, 'Restaurant', 1, 'fa-solid fa-utensils'),
(NULL, 'Cafe', 1, 'fa-solid fa-mug-hot'),
(NULL, 'Bills & Utilities', NULL, 'fa-solid fa-file-invoice'),
(NULL, 'Phone', 4, 'fa-solid fa-phone'),
(NULL, 'Internet', 4, 'fa-solid fa-wifi'),
(NULL, 'Gas', 4, 'fa-solid fa-fire-flame-simple'),
(NULL, 'Electricity', 4, 'fa-solid fa-bolt'),
(NULL, 'Rentals', 4, 'fa-solid fa-house-user'),
(NULL, 'Transportation', NULL, 'fa-solid fa-car'),
(NULL, 'Parking', 10, 'fa-solid fa-square-parking'),
(NULL, 'Maintenance', 10, 'fa-solid fa-wrench'),
(NULL, 'Petrol', 10, 'fa-solid fa-gas-pump'),
(NULL, 'Taxi', 10, 'fa-solid fa-taxi'),
(NULL, 'Public Transportation', 10, 'fa-solid fa-bus'),
(NULL, 'Shopping', NULL, 'fa-solid fa-bag-shopping'),
(NULL, 'Clothing', 16, 'fa-solid fa-shirt'),
(NULL, 'Footwear', 16, 'fa-solid fa-shoe-prints'),
(NULL, 'Electronics', 16, 'fa-solid fa-mobile-screen-button'),
(NULL, 'Accessories', 16, 'fa-solid fa-gem'),
(NULL, 'Entertainment', NULL, 'fa-solid fa-face-laugh-beam'),
(NULL, 'Games', 21, 'fa-solid fa-gamepad'),
(NULL, 'Movies', 21, 'fa-solid fa-film'),
(NULL, 'Music', 21, 'fa-solid fa-music'),
(NULL, 'Others', NULL, 'fa-solid fa-box')
;


--
-- Table structure for table `records`
--

CREATE TABLE `expenses` (
  `expenseID` int(11) NOT NULL AUTO_INCREMENT,
  `amount` decimal(10,2) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `note` varchar(255) NOT NULL,
  `date` DATE NOT NULL,
  `paymentType` varchar(50) NOT NULL,
  `image` varchar(255),
  PRIMARY KEY (`expenseID`),
  FOREIGN KEY (`categoryID`) REFERENCES categories(`categoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `expenses` AUTO_INCREMENT = 1000;

--
-- Dumping data for table `records`
--

INSERT INTO `expenses` (`expenseID`, `amount`, `categoryID`, `note`, `date`, `image`, `paymentType`) VALUES
(NULL, 20, 5, 'Vodafone X', '2022-01-01', NULL, "Debit Card"),
(NULL, 12.5, 2, 'Mcdonalds', '2022-01-01', NULL, "Cash"),
(NULL, 200, 19, 'Airpods', '2022-01-05', NULL, "Credit Card"),
(NULL, 28.89, 1, 'Groceries', '2022-01-07', NULL, "Debit Card"),
(NULL, 40, 17, 'Zara', '2022-01-09', NULL, "Debit Card"),
(NULL, 70, 18, 'Nike', '2022-01-09', NULL, "Debit Card"),
(NULL, 17, 15, 'Dublin-Dundalk bus', '2022-01-09', NULL, "Cash"),
(NULL, 3.5, 3, 'Costa', '2022-01-11', NULL, "Cash"),
(NULL, 5.5, 1, 'Milk tea', '2022-01-14', NULL, "Cash"),
(NULL, 10.5, 2, 'KFC', '2022-01-14', NULL, "Debit Card"),
(NULL, 15, 20, 'Earrings', '2022-01-17', NULL, "Debit Card"),
(NULL, 30, 8, 'Dec 21-Jan 22', '2022-01-01', NULL, "Cash"),
(NULL, 20, 6, 'Biznet', '2022-01-01', NULL, "Debit Card"),
(NULL, 5, 24, 'Spotify', '2022-01-01', NULL, "Credit Card"),
(NULL, 400, 9, 'Room', '2022-01-28', NULL, "Cash")
;



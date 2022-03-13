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
  `note` varchar(255),
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

INSERT INTO `expenses` (`expenseID`, `amount`, `categoryID`, `note`, `date`, `paymentType`, `image`) VALUES
(NULL, '20.00', 5, 'Vodafone X', '2022-01-01', 'Debit Card', NULL),
(NULL, '200.00', 19, 'Airpods', '2022-01-05', 'Credit Card', '199698.jpeg'),
(NULL, '28.89', 1, 'Groceries', '2022-01-07', 'Debit Card', '363061.jpg'),
(NULL, '40.00', 17, 'Zara', '2022-01-09', 'Debit Card', NULL),
(NULL, '70.00', 18, 'Nike', '2022-01-09', 'Debit Card', '975586.png'),
(NULL, '17.00', 15, 'Dublin-Dundalk bus', '2022-01-09', 'Cash', NULL),
(NULL, '3.50', 3, 'Costa', '2022-01-11', 'Cash', '45434.jpg'),
(NULL, '5.50', 1, 'Milk tea', '2022-02-25', 'Cash', '953062.jpg'),
(NULL, '10.50', 2, 'KFC', '2022-02-26', 'Debit Card', '96868.jpeg'),
(NULL, '15.00', 20, 'Earrings', '2022-01-17', 'Debit Card', '568119.jpeg'),
(NULL, '30.00', 8, 'Dec 21-Jan 22', '2022-01-01', 'Cash', NULL),
(NULL, '20.00', 6, 'Biznet', '2022-01-19', 'Debit Card', ''),
(NULL, '5.00', 24, 'Spotify', '2022-01-01', 'Credit Card', NULL),
(NULL, '400.00', 9, 'Room', '2022-01-28', 'Cash', NULL),
(NULL, '8.00', 2, 'Pizza Hut', '2022-01-20', 'Cash', '899458.jpg');



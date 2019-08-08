---------------------------------------------
-- a sql query từ 2017-12-15 đến 2018-01-15 theo loggingTime
SELECT * FROM 
( 
SELECT * FROM mtlog201712
 UNION ALL 
 SELECT * FROM mtlog201801 
 UNION ALL 
 SELECT * FROM mtlog201802 
 ) as new 
 WHERE 
 loggingTime BETWEEN '2017-12-15 00:00:00' AND '2018-01-15 23:59:59'
 
---------------------------------------
-- b sql query đếm số giao dịch, số tiền theo ngày và từ ngày đến ngày
SELECT 
DATE(new.loggingTime) as 'thời gian',
count(new.id) as 'tổng giao dịch',
SUM(new.money) as 'tổng tiền' 
FROM 
( 
SELECT * FROM mtlog201712 
UNION ALL 
SELECT * FROM mtlog201801 
UNION ALL 
SELECT * FROM mtlog201802 
) as new 
WHERE 
new.loggingTime BETWEEN '2018-01-01 00:00:00' AND '2018-01-15 23:59:59' 
GROUP BY DATE(new.loggingTime)
---------
-- b sql query đếm số giao dịch, số tiền theo thời gian 3 tháng hiện tại trở lại (2019-05-08 đến 2019-08-08)
SELECT DATE(new.loggingTime) as 'thời gian',
count(new.id) as 'tổng giao dịch',
SUM(new.money) as 'tổng tiền' 
FROM ( 
SELECT * FROM mtlog201712 
UNION ALL 
SELECT * FROM mtlog201801 
UNION ALL 
SELECT * FROM mtlog201802 
) as new 
WHERE 
new.loggingTime BETWEEN CONCAT(DATE(NOW() - INTERVAL 3 MONTH),' 00:00:00') 
AND 
NOW() GROUP BY DATE(new.loggingTime)
----------
-- b sql query đếm số giao dịch, số tiền theo thời gian 3 tháng hiện tại trở lại (2019-06-01 đến 2019-08-08)
SELECT 
DATE(new.loggingTime) as 'thời gian',
count(new.id) as 'tổng giao dịch',
SUM(new.money) as 'tổng tiền' 
FROM ( 
SELECT * FROM mtlog201712 
UNION ALL 
SELECT * FROM mtlog201801 
UNION ALL 
SELECT * FROM mtlog201802 
) as new 
WHERE 
new.loggingTime BETWEEN CONCAT(DATE_ADD(DATE_ADD(LAST_DAY(NOW()), INTERVAL 1 DAY), INTERVAL - 3 MONTH),' 00:00:00') AND NOW() 
GROUP BY DATE(new.loggingTime)
----------------------------
-- c trigger cập nhật thời gian autotimestamp khi cập nhật dữ liệu
-- DROP TRIGGER IF EXISTS before_update;
DELIMITER $$
CREATE TRIGGER before_update BEFORE UPDATE ON mtlog201801 
FOR EACH ROW
BEGIN
    SET new.autotimestamp = NOW();
END $$
DELIMITER;
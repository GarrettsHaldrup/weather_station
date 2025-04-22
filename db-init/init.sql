/* 
 Intial Database setup
 Author: Garrett Haldrup
 Description: Creates the database one docker build, just one table
*/
USE weatherdb;

CREATE TABLE IF NOT EXISTS weather_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    temperature FLOAT,
    humidity FLOAT,
    pressure FLOAT,
    wind_speed FLOAT,
    recorded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

SET GLOBAL time_zone = 'America/New_York';
SET time_zone = 'America/New_York';
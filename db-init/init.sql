USE weatherdb;

CREATE TABLE IF NOT EXISTS weather_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    temperature FLOAT,
    humidity FLOAT,
    pressure FLOAT,
    recorded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

SET GLOBAL time_zone = 'America/New_York';
SET time_zone = 'America/New_York';
# Weather Station
### By Garrett Haldrup and Zach Bricker
---
## Setup
1. Download Docker to pi
```bash
curl -sSL https://get.docker.com | sh
```
2. Add yourself to the group
```bash
sudo usermod -aG docker "YOUR USER"
newgrp docker
```
3. Run the Containers
```bash
docker composer up -d --build
```
4. Accesss the Website
```
http://YOUR_PI_IP
```

## Developent
### Usefull Docker Commands
```bash
docker composer up -d --build
```
- This will rebuild and restart all containers
- Use after changing code and want to see effect
```bash
docker composer down
```
- To stop all containers
- Keeps all data
```bash
docker composer down -v
```
- Stops all containers
- Also will remove all data on containers

### Getting data to database
View collector.py is the final endpoint that sends data to be upload to database  
Look at test_data.py to see how data is exported to the collector

## TODO
1. Get Sensors Working (Zach, Garrett)
2. ~~Add Graph to website (Garrett)~~
3. Make website pretty (Garrett)
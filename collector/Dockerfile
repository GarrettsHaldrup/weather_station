# Docker file for collector setup
# Author: Garrett Haldrup
# Description: Gets python and all needed libraries installed on container

FROM python:3.11-slim

WORKDIR /app

COPY requirements.txt ./

# Install dependencies for lgpio
RUN apt-get update && apt-get install -y \
    git \
    make \
    gcc \
    wget \
    unzip \
    libcap-dev \
    python3-dev \
    swig \
    python3-setuptools \
    python3-libgpiod \
    libgpiod2 \
    && rm -rf /var/lib/apt/lists/*

RUN pip install lgpio pigpio gpio gpiozero

RUN wget https://github.com/Gadgetoid/PY_LGPIO/releases/download/0.2.2.0/lgpio-0.2.2.0.tar.gz
RUN pip install lgpio-0.2.2.0.tar.gz

RUN pip install --no-cache-dir -r requirements.txt
COPY . .

ENV PYTHONPATH=/app

CMD ["python", "-u", "collector.py"]
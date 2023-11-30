# News Aggregator App

## Overview

This project is a News Aggregator application that collects data from various news websites using APIs. It's built using the Laravel framework for the backend, React.js for the frontend, and utilizes MySQL as the database. Docker is used for containerization, making it easy to deploy and manage.

## Table of Contents

- [Features](#features)
- [Tech Stack](#tech-stack)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Docker Installation](#docker-installation)
  - [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Cron Job](#cron-job)
- [Contributing](#contributing)
- [License](#license)

## Features

- Aggregates news data from different sources.
- Utilizes APIs for fetching news content.
- Laravel backend for robust server-side logic.
- React.js frontend for a dynamic and responsive user interface.
- MySQL database for storing and retrieving news data.
- Docker containerization for easy deployment and scalability.

## Tech Stack

- **Backend**: Laravel
- **Frontend**: React.js
- **Database**: MySQL
- **Containerization**: Docker

## Getting Started

### Prerequisites

Before you begin, ensure you have met the following requirements:

- **Docker**: The application is containerized using Docker. Make sure you have Docker installed on your system.

  - **Linux**: Follow the [official Docker installation guide for Linux](https://docs.docker.com/engine/install/).
  - **Windows**: Follow the [official Docker installation guide for Windows](https://docs.docker.com/desktop/install/windows-install/).
  - **Mac**: Follow the [official Docker installation guide for Mac](https://docs.docker.com/desktop/install/mac-install/).

### Docker Installation

For detailed Docker installation instructions, refer to the official Docker documentation:

- [Docker Installation Guide for Linux](https://docs.docker.com/engine/install/)
- [Docker Installation Guide for Windows](https://docs.docker.com/desktop/install/windows-install/)
- [Docker Installation Guide for Mac](https://docs.docker.com/desktop/install/mac-install/)

### Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/mustabshirkhan/news-aggregator-app.git

2. Change into the project directory:

    ```cd news-aggregator-app```

### Configuration

1. Configure the Laravel environment:
    
    ```cd backend && cp .env.example .env```
2. In this application we have 3 data sources and you need to put your api keys in ./backend/.env/ after previous step.
    - NYT
    - The Guardian
    - News API
3. In .env we have following variables which needs to be setup with your api keys
   - NEWSAPI_API_KEY='API KEY'
   - NYT_API_KEY='API KEY'
   - THE_GUARDIAN_API_KEY='API KEY'

4. 


   

### Usage

1. Start the Docker containers:

   ```docker compose up```
2. Access the application:
   1. Frontend: http://localhost:3000
   2. Backend: http://localhost:9000
 

Explore and enjoy the News Aggregator app!

### Cron
A cron job has been set up to fetch data from various resources every day at 12:00 AM.

### License
This project is licensed under the [MIT license](https://opensource.org/licenses/MIT).


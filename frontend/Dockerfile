FROM node:latest

WORKDIR /app

CMD touch .env
# Install application dependencies
COPY package*.json ./
RUN npm install

# Copy application files
COPY . .

# Build the React app
RUN npm run build

# Expose port
EXPOSE 3000

# Run the application
CMD npm start

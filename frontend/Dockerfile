FROM node:18-alpine

WORKDIR /app

# Install application dependencies
COPY package*.json ./
RUN npm install --production

# Copy application files
COPY . .

# Build the React app
RUN npm run build

# Expose port
EXPOSE 3000

# Run the application
CMD npm start

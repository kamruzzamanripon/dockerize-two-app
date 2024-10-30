FROM node:23-alpine3.19 AS base
WORKDIR /app/web

COPY package.json package-lock.json ./
#RUN npm install -g @vue/cli && npm install
RUN npm install

COPY . .

### Development Stage
FROM base AS dev
EXPOSE 5173
CMD ["npm", "run", "dev"]

### Build Stage
FROM base AS build
RUN npm run build
CMD ["npm", "run", "dev"]

### Production Stage with Nginx
FROM nginx:stable-alpine AS prod
COPY --from=build /app/web/dist /usr/share/nginx/html
COPY nginx.conf /etc/nginx/nginx.conf
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]

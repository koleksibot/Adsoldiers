module.exports = {
  apps: [
    {
      name: "nuxt",
      script: "./node_modules/.bin/nuxt",
      env: {
        HOST: "0.0.0.0",
        PORT: 12345,
        NODE_ENV: "production"
      }
    }
  ]
};

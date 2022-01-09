const bodyParser = require("body-parser");

export default (req, res, next) => {
  console.log(req);

  console.log("Hi Medium! This log will print for all requests");
};

// index.js
const express = require("express");
const cors = require("cors");
const midtransClient = require("midtrans-client");
require("dotenv").config();

const app = express();
app.use(cors());
app.use(express.json());

app.post("/", async (req, res) => {
  const snap = new midtransClient.Snap({
    isProduction: false,
    serverKey: process.env.MIDTRANS_SERVER_KEY,
  });

  try {
    const token = await snap.createTransaction(req.body);
    res.json({ snap_token: token.token });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

app.listen(process.env.PORT || 3000, () => {
  console.log("Server is running");
});

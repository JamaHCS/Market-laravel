use market;

db.users.insert({
  fb_token: "laksjdhflaksjdhflasjkdhf",
  name: "Hector Jama Escobedo",
  email: "jamahcs@outlook.com",
  password_verified: true,
  password: "$2y$10$A20pBjSAdchDWQElpmjSV.o7Qvcx5W/E3iJ8E0K.6MmwKGETpBSQS",
});

db.market_types.insert({
  name: "Bazar",
});

db.locations.insert({
  latitude: 20.654064957407833,
  longitude: -100.40611526026878,
});

db.markets.insert({
  uuid: "asdfla",
  name: "Tienda de doña pelos",
  logo: "logos/logo.svg",
  user_id: "60734e9eba520000b4003fc2",
  location_id: "asdflhjk0789kbnlhjk",
  type_id: "60734e9eba520000b4003fc3",
});

db.products.insert({
"is_active": true,
  "name": "Cheetos Flamin´ Hot 145gr",
  "type": "Botanas",
  "brand": "Frito-Lay",
  "price": 13,
  "cost": 10,
  "market_id": "60734e9eba520000b4003fc7",
});

db.sells.insert({
  "market_id": "60734e9eba520000b4003fc7",
  "user_id": "60734e9eba520000b4003fc1",
});

db.sell_details.insert({
  "quant": 3,
  "total": 90,
  "sell_id": "60734e9eba520000b4004000",
  "product_id": "60734e9eba520000b4003fd2",
});

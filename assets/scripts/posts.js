"use strict";
let url = "https://randomuser.me/api/?results=10";
const filterData = json => {
  return json.results.map(user => {
    return {
      firstname: user.name.first,
      lastname: user.name.last,
      username: user.login.username,
      email: user.email,
      avatar: user.picture.thumbnail
    };
  });
};
fetch(url)
  .then(res => res.json())
  .then(data => {
    const filtered = filterData(data);
    // filtered.forEach() => {
    //
    // });
  });

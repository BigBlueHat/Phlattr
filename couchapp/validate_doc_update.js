function (newDoc, oldDoc, userCtx) {
  if (!user_is('phlattr')) {
    throw({unauthorized: "Sorry, only phlattr members can update this db."});
  }
  required('phones', 'Sorry, we only like phone documents around here.');
  

  function required(field, message /* optional */) {
    message = message || "Document must have a " + field;
    if (!newDoc[field]) throw({forbidden : message});
  }

  function unchanged(field) {
    if (oldDoc && toJSON(oldDoc[field]) != toJSON(newDoc[field]))
      throw({forbidden : "Field can't be changed: " + field});
  }

  function user_is(role) {
    return userCtx.roles.indexOf(role) >= 0;
  }
}

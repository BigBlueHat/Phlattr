/**
 * Log stuff into a 'log' key in a doc 
 */
function(doc, req) {
  if (!doc) {
    return [null, {code:404}];
  }
  var now = Date.now();
  var entry = {};
  entry[now] = JSON.parse(req.body);

  if (doc.log && Array.isArray(doc.log)) {
    doc.log.push(entry);
  } else {
    doc.log = [entry];
  }
  return [doc, {}];
}
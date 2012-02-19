/**
 * Mark a phlattry document as confirmed 
 */
function(doc, req) {
  if (!doc) {
    return [null, {code:404}];
  }
  
  if (doc.user && doc.wants_to_phlattr && doc.confirmed == null) {
    doc.confirmed = Date.now();
    return [doc, {}];
  }
}
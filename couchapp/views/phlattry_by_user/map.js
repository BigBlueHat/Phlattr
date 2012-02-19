/**
 * Find phlattry documents and their history by user id 
 */
function(doc) {
  if (doc.user && doc.wants_to_phlattr) {
    emit([doc.user.id, doc.requested, doc.confirmed], doc);
  }
}
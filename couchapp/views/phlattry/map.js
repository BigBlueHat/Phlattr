/**
 * Find all phlattry documentents listed by their requested & confirmed keys 
 */
function(doc) {
  if (doc.user && doc.wants_to_phlattr) {
    // outputting the user id as _id for use with ?include_docs "joining"
    var output = {_id: doc.user.id,
                  user: doc.user,
                  wants_to_phlattr: doc.wants_to_phlattr};
    emit(['requested', doc.requested], output);
    emit(['confirmed', doc.confirmed], output);
  }
}
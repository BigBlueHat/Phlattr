function(doc) {
  if (doc.phones) {
    for (var phone in doc.phones) {
      emit(doc.phones[phone].confirmed, phone);
    }
  }
}
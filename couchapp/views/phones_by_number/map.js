function(doc) {
  if (doc.phones) {
    for (var phone in doc.phones) {
      emit(phone, doc.phones[phone].confirmed);
    }
  }
}
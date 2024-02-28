// Admin,Vat Expert,Consultant,Data Entry Specialist

export default {
//    docs section
  allAccess: ['admin', 'vat expert', 'consultant', 'data entry specialist'],
  contactsFolderAccess: ['admin', 'vat expert', 'consultant'],
  allPermissions(role) {
    if (this.allAccess.find(rol => rol === role?.toLowerCase())) {
      return true
    }
    return false
  },
  uploadButtonPermissions(role) {
    return this.allPermissions(role)
  },
  contactsFolderPermissions(role) {
    if (this.contactsFolderAccess.find(rol => rol === role?.toLowerCase())) {
      return true
    }
    return false
  },
  ReviewFileAccess(role) {
    return this.contactsFolderPermissions(role)
  },
  failedFileAccess(role) {
    // although both access are same
    return this.allPermissions(role)
  },
  addTransaction(role) {
    // although both access are same
    return this.allPermissions(role)
  },
  approvePermission(role) {
    // although both access are same
    return this.contactsFolderPermissions(role)
  },
  rejectPermission(role) {
    return this.contactsFolderPermissions(role)
  },
  ReviewTransaction(role) {
    // although both access are same
    return this.contactsFolderPermissions(role)
  },
  viewDocsPagePermission(role) {
    // although both access are same
    return this.allPermissions(role)
  },
  // ********docs permission access end******//

  //    ***user access**** ///
  addUserPermission(role) {
    // although both access are same
    return this.contactsFolderPermissions(role)
  },
  viewUserPermission(role) {
    // although both access are same
    return this.contactsFolderPermissions(role)
  },
  /// **** User access permissions  ///

  /// reports access
  viewReportNinePointOne(role) {
    // although both access are same
    return this.allPermissions(role)
  },
  viewReportsPermissions(role) {
    // although both access are same
    return this.allPermissions(role)
  },
  /// reports access
  viewReportNinePointOneSubForm(role) {
    // although both access are same
    return this.allPermissions(role)
  },
  // /end of reports access

}

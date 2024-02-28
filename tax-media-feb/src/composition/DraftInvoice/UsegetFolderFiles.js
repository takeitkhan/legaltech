import { ref } from '@vue/composition-api'

export default function UsegetFolderFiles(contaxt) {
  console.log(contaxt);
  const filesViaDocument = ref([])

  function showFilesInFileList(document) {
    console.log(document.activeFolder)
    contaxt.emit('showFilesOfContact', document.contactId)
  }
  return {
    showFilesInFileList,
    filesViaDocument,
  }
}

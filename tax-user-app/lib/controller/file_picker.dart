import 'dart:io';

import 'package:flutter_image_compress/flutter_image_compress.dart';
import 'package:get/get.dart';
import 'package:image_picker/image_picker.dart';
import 'package:path_provider/path_provider.dart';

class FilePickerController extends GetxController {
  final ImagePicker picker = ImagePicker();
  Future<XFile?> pickImageFromCamera() async {
    try {
      final XFile? image = await picker.pickImage(source: ImageSource.camera);

      Directory tempDir = await getTemporaryDirectory();
      String tempPath = tempDir.path;

      var result = await FlutterImageCompress.compressAndGetFile(
        image!.path,
        tempPath + '/image.jpeg',
        quality: 50,
      );
      return XFile(result!.path);
    } on Exception {
      return null;
    }
  }
  var compressFile = [];
  Future<List?> pickImageFromGallery() async {
    try {
      final List<XFile>? images = await picker.pickMultiImage();
      if (images != null) {
        for (var image in images) {
          var result = await FlutterImageCompress.compressAndGetFile(
            image.path,
            image.path + 'image.jpeg',
            quality: 50,
          );
          compressFile.add(result);
        }
      }

      if (compressFile.isNotEmpty) {
        return compressFile;
      }
      return null;
    } on Exception {
      return null;
    }
  }
}

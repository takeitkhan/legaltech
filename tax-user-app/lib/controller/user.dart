import 'dart:convert';

import 'package:flutter/cupertino.dart';
import 'package:flutter/foundation.dart';
import 'package:get/get.dart';
import 'package:http/http.dart' as http;
import 'package:http_parser/http_parser.dart';
import 'package:mime/mime.dart';
import 'package:user/app_constants/app_constants.dart';
import 'package:user/helper/api_client.dart';
import 'package:user/model/entity.dart';
import 'package:user/model/files.dart';

class UserController extends GetxController {
  final apiClient = Get.find<ApiClient>();
  bool isLoading = false;
  int? currentEntityId;
  List<Entity> allEntities = [];
  List<Document> allFiles = [];

  Future<bool> getEntities() async {
    update();
    http.Response response = await apiClient.get(AppConstants.etities);
    if (response.statusCode == 200) {
      final data = jsonDecode(response.body);
      allEntities.clear();
      data['entities'].forEach((e) {
        allEntities.add(Entity.fromMap(e));
      });
      currentEntityId = Entity.fromMap(data!['entities'][0]).id;
      return true;
    } else {
      return false;
    }
  }

  Future<bool> uploadFiles({
    required String id,
    required List<String> filePaths,
  }) async {
    isLoading = true;
    update();
    final List<http.MultipartFile> files = [];
    for (var path in filePaths) {
      final file = await http.MultipartFile.fromPath(
        'file',
        path,
        filename: 'file-${DateTime.now().toIso8601String()}.jpg',
        contentType: MediaType.parse(lookupMimeType(path) ?? ''),
      );
      if (kDebugMode) {
        print("File: $path");
      }
      files.add(file);
    }
    if (kDebugMode) {
      print(' print id on body : $id');
    }
    http.Response response = await apiClient.multipartRequest(
      AppConstants.upload,
      files: files,
      body: {'entity_id': id},
    );
    if (kDebugMode) {
      print("Response :${response.body}");
    }
    if (response.statusCode == 200) {
      final data = jsonDecode(response.body);
      final message = data['message'];
      Get.showSnackbar(
        GetSnackBar(
          message: message,
          borderRadius: 5,
          margin: const EdgeInsets.all(16).copyWith(bottom: 20),
          backgroundColor: const Color(0xFF6148FA).withOpacity(0.8),
          duration: const Duration(seconds: 2),
          dismissDirection: DismissDirection.horizontal,
        ),
      );
      isLoading = false;
      update();
      return true;
    }
    return false;
  }

  Future<bool> getFiles(String id) async {
    isLoading = true;
    update();
    http.Response response =
        await apiClient.get(AppConstants.getFils + id + '/draft');
    if (response.statusCode == 200) {
      final data = jsonDecode(response.body);
      allFiles = GetFiles.fromJson(data).documents;
      allFiles.sort(((a, b) => b.createdAt.compareTo(a.createdAt)));
      isLoading = false;
      update();
      return true;
    }
    return false;
  }
}

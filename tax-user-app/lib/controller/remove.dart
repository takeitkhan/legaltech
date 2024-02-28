import 'dart:convert';

import 'package:flutter/foundation.dart';
import 'package:get/get.dart';
import 'package:http/http.dart' as http;
import 'package:user/app_constants/app_constants.dart';
import 'package:user/helper/api_client.dart';

class RemoveController extends GetxController {
  final apiClient = Get.find<ApiClient>();

  Future<bool> trashDocument(int entityID, int transactionID) async {
    http.Response response = await apiClient.post(
      AppConstants.trashDocument +
          entityID.toString() +
          '/' +
          transactionID.toString(),
    );
    if (response.statusCode == 200) {
      if (kDebugMode) {
        print(jsonDecode(response.body));
      }
      return true;
    }
    return false;
  }
}

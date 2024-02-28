import 'dart:convert';

import 'package:get/get.dart';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';
import 'package:user/app_constants/app_constants.dart';
import 'package:user/helper/api_client.dart';
import 'package:user/model/user.dart';

class AuthController extends GetxController {

  User? currentUser;
  final apiClient = Get.find<ApiClient>();
  bool isLoading = false;
  
  Future<bool> login(String number, String password) async {
    isLoading = true;
    update();
    http.Response response = await ApiClient().post(
      AppConstants.login,
      body: jsonEncode(
        {
          "phone": number,
          "password": password,
        },
      ),
    );
    isLoading = false;
    update();
    if (response.statusCode == 200) {
      final data = jsonDecode(response.body);
      final token = data['data']['token'];
      SharedPreferences preferences = await SharedPreferences.getInstance();
      preferences.setString('token', token);
      isLoading = false;
      update();
      return true;
    }
    return false;
  }

  Future<bool> currentUserInfo() async {
    http.Response response = await apiClient.get(AppConstants.currentUser);
    if (response.statusCode == 200) {
      final data = jsonDecode(response.body);
      final user = User.fromMap(data['user']);
      currentUser = user;
      return true;
    }
    return false;
  }
}

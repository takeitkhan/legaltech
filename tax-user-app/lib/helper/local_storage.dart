import 'package:get/get.dart';
import 'package:shared_preferences/shared_preferences.dart';

class LocalStorageController extends GetxController {
  Future<String?> getToken() async {
    final SharedPreferences preferences = await SharedPreferences.getInstance();
    return preferences.getString('token');
  }

  Future<void> saveToken(String token) async {
    final SharedPreferences preferences = await SharedPreferences.getInstance();
    await preferences.setString('token', token);
  }

  Future<GetSnackBar> removeToken() async {
    final SharedPreferences preferences = await SharedPreferences.getInstance();
    preferences.remove('token');
    return const GetSnackBar(
      title: 'Succesful',
      message: 'Logout Succesfuly',
    );
  }
}

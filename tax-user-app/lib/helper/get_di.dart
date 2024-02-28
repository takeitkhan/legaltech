import 'package:get/get.dart';
import 'package:user/controller/auth.dart';
import 'package:user/controller/file_picker.dart';
import 'package:user/controller/remove.dart';
import 'package:user/controller/user.dart';
import 'package:user/helper/api_client.dart';
import 'package:user/helper/local_storage.dart';

Future<void> init() async {
  Get.lazyPut(() => ApiClient());
  Get.lazyPut(() => AuthController());
  Get.lazyPut(() => UserController());
  Get.lazyPut(() => LocalStorageController());
  Get.lazyPut(() => FilePickerController(), fenix: true);
  Get.lazyPut(() => RemoveController());
}

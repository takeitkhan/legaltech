import 'dart:async';

import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:user/controller/auth.dart';
import 'package:user/controller/user.dart';
import 'package:user/helper/api_client.dart';
import 'package:user/helper/local_storage.dart';
import 'package:user/view/screen/login.dart';
import 'package:user/view/screen/transaction.dart';

class SplashScreen extends StatefulWidget {
  const SplashScreen({Key? key}) : super(key: key);

  @override
  State<SplashScreen> createState() => _SplashScreenState();
}

class _SplashScreenState extends State<SplashScreen> {
  @override
  void initState() {
    init();
    super.initState();
  }

  Future<void> init() async {
    final token = await Get.find<LocalStorageController>().getToken();
    Get.find<ApiClient>().token = token;
    if (kDebugMode) {
      print("token: ${Get.find<ApiClient>().token}");
    }
    if (Get.find<ApiClient>().token == null) {
      Get.offAll(() => const LoginScreen(), transition: Transition.fadeIn);
    } else {
      await Get.find<AuthController>().currentUserInfo();
      await Get.find<UserController>().getEntities();
      Get.offAll(() => const Transaction(), transition: Transition.fadeIn);
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Center(
        child: Text(
          'Taxes Media',
          style: TextStyle(
            color: Theme.of(context).colorScheme.primary,
            fontSize: 24,
          ),
        ),
      ),
    );
  }
}

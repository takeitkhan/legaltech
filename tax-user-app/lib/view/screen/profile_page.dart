import 'package:cached_network_image/cached_network_image.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:user/controller/auth.dart';
import 'package:user/helper/local_storage.dart';
import 'package:user/helper/size_config.dart';
import 'package:user/view/screen/login.dart';
import 'package:user/view/widgets/custom_dialoge.dart';

class ProfilePage extends StatelessWidget {
  const ProfilePage({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    double height = SizeConfig.getHeight(context);
    return GetBuilder<AuthController>(builder: (controller) {
      return Scaffold(
        body: Stack(
          clipBehavior: Clip.none,
          children: [
            Container(
              height: height / 4,
              width: double.infinity,
              decoration: const BoxDecoration(
                borderRadius: BorderRadius.only(
                  bottomLeft: Radius.circular(20),
                  bottomRight: Radius.circular(20),
                ),
                image: DecorationImage(
                    image: AssetImage('asset/company.jpg'), fit: BoxFit.cover),
              ),
              // child: ,
            ),
            Positioned(
              top: 20,
              left: 10,
              child: IconButton(
                onPressed: () => Get.back(),
                icon: const Icon(
                  Icons.arrow_back,
                  color: Colors.white,
                ),
              ),
            ),
            Positioned(
              left: 100,
              right: 100,
              top: 150,
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.center,
                children: [
                  Container(
                    height: 70,
                    width: 70,
                    decoration: BoxDecoration(
                      border: Border.all(
                        color: Colors.white,
                        width: 2,
                      ),
                      shape: BoxShape.circle,
                    ),
                    child: Hero(
                      tag: 1,
                      child: CachedNetworkImage(
                        imageUrl: controller.currentUser!.avatar,
                        imageBuilder: (context, imageProvider) => Container(
                          height: 60,
                          width: 60,
                          decoration: BoxDecoration(
                            shape: BoxShape.circle,
                            image: DecorationImage(
                              image: imageProvider,
                              fit: BoxFit.cover,
                            ),
                          ),
                        ),
                      ),
                    ),
                  ),
                  Text(
                    controller.currentUser!.name,
                    style: const TextStyle(
                        fontSize: 16, fontWeight: FontWeight.bold),
                  ),
                  const SizedBox(height: 5),
                  Text(
                    controller.currentUser!.type,
                    style: const TextStyle(fontSize: 10, color: Colors.black45),
                  )
                ],
              ),
            ),
            Center(
              child: ElevatedButton(
                onPressed: () {
                  showDialog(
                    context: context,
                    builder: (context) => CustomDialog(
                      imageUrl: 'asset/remove.png',
                      title: 'Are you sure?',
                      description: 'Do you realy want to logout?',
                      confirmText: 'Logout',
                      onPressed: () async {
                        Get.to(() => const LoginScreen());

                        await Get.find<LocalStorageController>().removeToken();
                        Get.showSnackbar(
                          GetSnackBar(
                            message: 'Logout succesfuly!',
                            borderRadius: 5.0,
                            margin:
                                const EdgeInsets.all(16).copyWith(bottom: 20),
                            backgroundColor:
                                const Color(0xFF6148FA).withOpacity(0.8),
                            duration: const Duration(seconds: 2),
                            dismissDirection: DismissDirection.horizontal,
                          ),
                        );
                      },
                    ),
                  );
                },
                child: const Text('Logout'),
              ),
            )
          ],
        ),
      );
    });
  }
}

import 'package:cached_network_image/cached_network_image.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:get/get.dart';
import 'package:image_picker/image_picker.dart';
import 'package:permission_handler/permission_handler.dart';
import 'package:user/controller/auth.dart';
import 'package:user/controller/file_picker.dart';
import 'package:user/controller/remove.dart';
import 'package:user/controller/user.dart';
import 'package:user/helper/size_config.dart';
import 'package:user/view/screen/notifications.dart';
import 'package:user/view/screen/profile_page.dart';
import 'package:user/view/screen/transaction_details.dart';
import 'package:user/view/widgets/custom_dialoge.dart';

class Transaction extends StatefulWidget {
  const Transaction({Key? key}) : super(key: key);

  @override
  State<Transaction> createState() => _TransactionState();
}

class _TransactionState extends State<Transaction> {
  @override
  initState() {
    WidgetsBinding.instance!.addPostFrameCallback((_) {
      Get.find<UserController>().getFiles(
        Get.find<UserController>().currentEntityId.toString(),
      );
      Get.find<UserController>().getEntities();
    });
    super.initState();
  }

  bool isListView = false;
  final List<XFile> images = [];
  final ScrollController scrollController = ScrollController();
  
  @override
  Widget build(BuildContext context) {
    double height = SizeConfig.getHeight(context);
    final listOfitem = Get.find<UserController>().allEntities;
    return GestureDetector(
      onTap: (() => FocusScope.of(context).unfocus()),
      child: Scaffold(
        appBar: AppBar(
          automaticallyImplyLeading: false,
          title: DropdownButton<int>(
              underline: const SizedBox(),
              value: Get.find<UserController>().currentEntityId,
              icon: const Icon(Icons.keyboard_arrow_down),
              items: listOfitem
                  .map(
                    (item) => DropdownMenuItem(
                      value: item.id,
                      child: Text(item.name.toString()),
                    ),
                  )
                  .toList(),
              onChanged: (int? newValue) {
                Get.find<UserController>().getFiles(newValue.toString());
                setState(() {
                  Get.find<UserController>().currentEntityId = newValue;
                });
              }),
          actions: [
            Padding(
              padding: const EdgeInsets.only(right: 8.0),
              child: Row(
                children: [
                  IconButton(
                    onPressed: () => Get.to(
                      () => const Notifications(),
                      transition: Transition.fadeIn,
                    ),
                    icon: const Icon(
                      Icons.notifications,
                      color: Colors.black,
                    ),
                  ),
                  GestureDetector(
                    onTap: (() => Get.to(
                          () => const ProfilePage(),
                          transition: Transition.fadeIn,
                        )),
                    child: Container(
                      height: 38,
                      width: 38,
                      decoration: BoxDecoration(
                        shape: BoxShape.circle,
                        border: Border.all(
                            color: Theme.of(context).colorScheme.primary,
                            width: 2),
                        color: Colors.white,
                      ),
                      child: Padding(
                        padding: const EdgeInsets.all(2),
                        child: Hero(
                          tag: 1,
                          child: CircleAvatar(
                            backgroundImage: CachedNetworkImageProvider(
                              Get.find<AuthController>().currentUser!.avatar,
                            ),
                          ),
                        ),
                      ),
                    ),
                  ),
                ],
              ),
            )
          ],
          backgroundColor: Colors.white,
          elevation: 0,
        ),
        floatingActionButton: FloatingActionButton(
          onPressed: () async {
            Map<Permission, PermissionStatus> statuse =
                await [Permission.camera, Permission.storage].request();
            if (await Permission.camera.isGranted &&
                await Permission.storage.isGranted) {
              filePickerDialog(context);
            }
          },
          child: const Icon(Icons.add),
        ),
        body: WillPopScope(
          onWillPop: () async {
            showDialog(
              context: context,
              builder: (context) => CustomDialog(
                imageUrl: 'asset/exit.png',
                title: 'Are you sure ?',
                description: 'Do you realy want to exit from app?',
                onPressed: () {
                  SystemNavigator.pop();
                },
                confirmText: 'Exit',
              ),
            );
            return false;
          },
          child: GetBuilder<UserController>(
            builder: ((controller) => controller.isLoading
                ? Center(
                    child: CircularProgressIndicator(
                      color: Theme.of(context).colorScheme.primary,
                    ),
                  )
                : SizedBox(
                    height: height,
                    child: RefreshIndicator(
                      color: Theme.of(context).colorScheme.primary,
                      onRefresh: () async {
                        Get.find<UserController>().getFiles(
                          Get.find<UserController>().currentEntityId.toString(),
                        );
                      },
                      child: controller.allFiles.isEmpty
                          ? const Center(
                              child: Text(
                                'Tap (+) icon to upload Transactions',
                                style: TextStyle(
                                  fontSize: 16,
                                  color: Colors.grey,
                                ),
                                textAlign: TextAlign.center,
                              ),
                            )
                          : Scrollbar(
                              controller: scrollController,
                              isAlwaysShown: true,
                              showTrackOnHover: true,
                              hoverThickness: 40,
                              thickness: 10,
                              interactive: true,
                              radius: const Radius.circular(14),
                              child: ListView.builder(
                                controller: scrollController,
                                padding: const EdgeInsets.symmetric(
                                    horizontal: 16, vertical: 8.0),
                                itemCount: controller.allFiles.length,
                                itemBuilder: ((context, index) => Stack(
                                      children: [
                                        Container(
                                          margin: const EdgeInsets.symmetric(
                                              vertical: 8.0),
                                          height: height / 4,
                                          width: double.infinity,
                                          decoration: BoxDecoration(
                                            border: Border.all(
                                                color: Colors.black, width: 1),
                                            borderRadius:
                                                BorderRadius.circular(12),
                                          ),
                                          child: InkWell(
                                            onTap: () {
                                              Get.to(() => TransactionDetails(
                                                  imageUrl: controller
                                                      .allFiles[index]
                                                      .fileAsImage,
                                                  imageID: controller
                                                      .allFiles[index].id,
                                                  name: controller
                                                      .allFiles[index]
                                                      .user
                                                      .name,
                                                  email: controller
                                                      .allFiles[index]
                                                      .user
                                                      .email,
                                                  number: controller
                                                      .allFiles[index]
                                                      .user
                                                      .phone,
                                                  fileName: controller
                                                      .allFiles[index].name,
                                                  uploadTime: controller
                                                      .allFiles[index]
                                                      .createdAt));
                                            },
                                            child: Hero(
                                              tag:
                                                  controller.allFiles[index].id,
                                              child: CachedNetworkImage(
                                                imageUrl: controller
                                                    .allFiles[index]
                                                    .fileAsImage,
                                                imageBuilder:
                                                    (context, imageProvider) =>
                                                        Container(
                                                  decoration: BoxDecoration(
                                                    borderRadius:
                                                        BorderRadius.circular(
                                                            11),
                                                    image: DecorationImage(
                                                      image: imageProvider,
                                                      fit: BoxFit.cover,
                                                    ),
                                                  ),
                                                ),
                                              ),
                                            ),
                                          ),
                                        ),
                                        Positioned(
                                          top: 20,
                                          right: 10,
                                          child: Container(
                                            height: 40,
                                            width: 40,
                                            decoration: BoxDecoration(
                                              borderRadius:
                                                  BorderRadius.circular(12),
                                              color:
                                                  Colors.grey.withOpacity(0.2),
                                            ),
                                            child: Center(
                                              child: IconButton(
                                                onPressed: () {
                                                  showDialog(
                                                    context: context,
                                                    builder: (context) =>
                                                        CustomDialog(
                                                      imageUrl:
                                                          'asset/delete.png',
                                                      title: 'Are you sure?',
                                                      description:
                                                          'Do you really want to delete this record',
                                                      confirmText: 'Delete',
                                                      onPressed: () async {
                                                        Get.back();
                                                        bool success =
                                                            await Get.find<
                                                                    RemoveController>()
                                                                .trashDocument(
                                                          Get.find<
                                                                  UserController>()
                                                              .currentEntityId!
                                                              .toInt(),
                                                          controller
                                                              .allFiles[index]
                                                              .id,
                                                        );
                                                        if (success) {
                                                          Get.find<
                                                                  UserController>()
                                                              .getFiles(
                                                            Get.find<
                                                                    UserController>()
                                                                .currentEntityId
                                                                .toString(),
                                                          );
                                                          Get.showSnackbar(
                                                            GetSnackBar(
                                                              message:
                                                                  'The document has been trashed Successfully',
                                                              borderRadius: 5,
                                                              margin: const EdgeInsets
                                                                      .all(16)
                                                                  .copyWith(
                                                                      bottom:
                                                                          20),
                                                              backgroundColor:
                                                                  const Color(
                                                                          0xFF6148FA)
                                                                      .withOpacity(
                                                                          0.8),
                                                              duration:
                                                                  const Duration(
                                                                      seconds:
                                                                          2),
                                                              dismissDirection:
                                                                  DismissDirection
                                                                      .horizontal,
                                                            ),
                                                          );
                                                        }
                                                      },
                                                    ),
                                                  );
                                                },
                                                icon: const Icon(
                                                  Icons.delete,
                                                  color: Colors.red,
                                                ),
                                              ),
                                            ),
                                          ),
                                        ),
                                        Positioned(
                                          left: 15,
                                          bottom: 20,
                                          child: SizedBox(
                                            height: 40,
                                            child: Row(
                                              mainAxisAlignment:
                                                  MainAxisAlignment
                                                      .spaceBetween,
                                              children: [
                                                SizedBox(
                                                  width: 250,
                                                  child: TextFormField(
                                                    style: const TextStyle(
                                                      color: Colors.black,
                                                    ),
                                                    decoration: InputDecoration(
                                                      fillColor: Colors.white,
                                                      filled: true,
                                                      hintText: 'Add a comment',
                                                      hintStyle: TextStyle(
                                                        color: Theme.of(context)
                                                            .colorScheme
                                                            .primary,
                                                        fontSize: 14,
                                                      ),
                                                      border:
                                                          OutlineInputBorder(
                                                        borderRadius:
                                                            BorderRadius
                                                                .circular(10),
                                                      ),
                                                      focusedBorder:
                                                          OutlineInputBorder(
                                                        borderRadius:
                                                            BorderRadius
                                                                .circular(10),
                                                      ),
                                                    ),
                                                  ),
                                                ),
                                                const SizedBox(width: 10),
                                                Container(
                                                  height: 40,
                                                  width: 40,
                                                  decoration: BoxDecoration(
                                                    shape: BoxShape.circle,
                                                    color: Theme.of(context)
                                                        .colorScheme
                                                        .primary,
                                                  ),
                                                  child: Center(
                                                    child: IconButton(
                                                      onPressed: () {},
                                                      icon: const Icon(
                                                        Icons.send,
                                                        color: Colors.white,
                                                      ),
                                                    ),
                                                  ),
                                                )
                                              ],
                                            ),
                                          ),
                                        )
                                      ],
                                    )),
                              ),
                            ),
                    ),
                  )),
          ),
        ),
      ),
    );
  }

  filePickerDialog(BuildContext context) {
    return showDialog(
      context: context,
      builder: (BuildContext context) => Dialog(
        elevation: 2,
        shape:
            RoundedRectangleBorder(borderRadius: BorderRadius.circular(20.0)),
        backgroundColor: Colors.white,
        child: Padding(
          padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 30),
          child: Column(
            mainAxisSize: MainAxisSize.min,
            crossAxisAlignment: CrossAxisAlignment.center,
            children: [
              Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: const [
                  ImageIcon(
                    AssetImage('asset/upload.png'),
                    size: 20,
                  ),
                  SizedBox(width: 5),
                  Text(
                    'Upload your file',
                    style: TextStyle(
                      fontSize: 16,
                      fontWeight: FontWeight.w600,
                    ),
                  ),
                ],
              ),
              const SizedBox(
                height: 20.0,
              ),
              Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  Container(
                    height: 60,
                    width: 60,
                    decoration: BoxDecoration(
                      color: Theme.of(context).colorScheme.primary,
                      shape: BoxShape.circle,
                    ),
                    child: IconButton(
                      onPressed: () async {
                        Get.back();
                        final image = await Get.find<FilePickerController>()
                            .pickImageFromCamera();
                        if (image != null) {
                          await Get.find<UserController>().uploadFiles(
                            id: Get.find<UserController>()
                                .currentEntityId
                                .toString(),
                            filePaths: [image.path],
                          );
                          WidgetsBinding.instance!.addPostFrameCallback((_) {
                            Get.find<UserController>().getFiles(
                              Get.find<UserController>()
                                  .currentEntityId
                                  .toString(),
                            );
                          });
                        }
                      },
                      icon: Center(
                        child: Image.asset(
                          'asset/camera.png',
                          height: 25,
                          width: 25,
                          color: Colors.white,
                        ),
                      ),
                    ),
                  ),
                  const SizedBox(width: 16.0),
                  Container(
                    height: 60,
                    width: 60,
                    decoration: BoxDecoration(
                      border: Border.all(color: Colors.black, width: 1),
                      shape: BoxShape.circle,
                    ),
                    child: IconButton(
                      onPressed: () async {
                        Get.back();
                        final images = await Get.find<FilePickerController>()
                            .pickImageFromGallery();
                        if (images != null) {
                          await Get.find<UserController>().uploadFiles(
                            id: Get.find<UserController>()
                                .currentEntityId
                                .toString(),
                            filePaths:
                                images.map((image) => image.path.toString()).toList(),
                          );
                          Get.find<UserController>().getFiles(
                            Get.find<UserController>()
                                .currentEntityId
                                .toString(),
                          );
                        }
                      },
                      icon: Center(
                        child: Image.asset(
                          'asset/gallery.png',
                          height: 25,
                          width: 25,
                        ),
                      ),
                    ),
                  ),
                ],
              )
            ],
          ),
        ),
      ),
    );
  }
}

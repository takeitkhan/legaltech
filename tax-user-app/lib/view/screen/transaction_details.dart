import 'package:cached_network_image/cached_network_image.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:intl/intl.dart';
import 'package:user/helper/size_config.dart';
import 'package:user/view/widgets/photo_viewer.dart';

class TransactionDetails extends StatelessWidget {
  const TransactionDetails(
      {Key? key,
      required this.imageUrl,
      required this.imageID,
      required this.name,
      required this.email,
      required this.number,
      required this.fileName,
      required this.uploadTime})
      : super(key: key);
  final String imageUrl;
  final int imageID;
  final String name;
  final String email;
  final String number;
  final String fileName;
  final DateTime uploadTime;
  @override
  Widget build(BuildContext context) {
    double height = SizeConfig.getHeight(context);
    return Scaffold(
      appBar: AppBar(
        title: const Text('Details'),
        centerTitle: true,
      ),
      body: ListView(
        children: [
          SizedBox(
            height: height / 3,
            child: InkWell(
              onTap: () => Get.to(() => PhotoViewer(
                    imageUrl: imageUrl,
                    imageID: imageID,
                  )),
              child: Hero(
                tag: imageID,
                child: CachedNetworkImage(
                  imageUrl: imageUrl,
                  fit: BoxFit.cover,
                ),
              ),
            ),
          ),
          const SizedBox(height: 10),
          SizedBox(
            height: height / 3,
            child: Padding(
              padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 20),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      Text(
                        name,
                        style: const TextStyle(
                          fontSize: 16,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                      Text(
                        email,
                        style: const TextStyle(
                          fontSize: 16,
                          fontWeight: FontWeight.bold,
                        ),
                      )
                    ],
                  ),
                  const SizedBox(height: 10),
                  Row(
                    children: [
                      const Text(
                        "Mobile number: ",
                        style: TextStyle(
                            fontSize: 16, fontWeight: FontWeight.bold),
                      ),
                      Text(
                        number,
                        style: const TextStyle(
                            fontSize: 14, fontWeight: FontWeight.bold),
                      )
                    ],
                  ),
                  const SizedBox(height: 10),
                  Row(children: [
                    const Text(
                      "File name: ",
                      style:
                          TextStyle(fontSize: 16, fontWeight: FontWeight.bold),
                    ),
                    Text(
                      fileName,
                      style: const TextStyle(
                          fontSize: 14, fontWeight: FontWeight.bold),
                    ),
                  ]),
                  const SizedBox(height: 10),
                  Row(children: [
                    const Text(
                      "Upload file: ",
                      style:
                          TextStyle(fontSize: 16, fontWeight: FontWeight.bold),
                    ),
                    Text(
                      DateFormat('yyyy-MM-dd  hh:mm a')
                          .format(uploadTime.toLocal()),
                      style: const TextStyle(
                          fontSize: 14, fontWeight: FontWeight.bold),
                    ),
                  ]),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }
}

import 'package:cached_network_image/cached_network_image.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:photo_view/photo_view.dart';

class PhotoViewer extends StatelessWidget {
  const PhotoViewer({
    Key? key,
    required this.imageUrl,
    required this.imageID,
  }) : super(key: key);
  final String imageUrl;
  final int imageID;
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        constraints:
            BoxConstraints.expand(height: MediaQuery.of(context).size.height),
        child: Stack(
          alignment: Alignment.bottomCenter,
          children: [
            PhotoView(
              imageProvider: CachedNetworkImageProvider(imageUrl),
              initialScale: PhotoViewComputedScale.contained,
              minScale: PhotoViewComputedScale.contained,
              maxScale: PhotoViewComputedScale.covered * 4.1,
              heroAttributes: PhotoViewHeroAttributes(tag: imageID),
            ),
            Positioned(
              left: 20,
              top: 40,
              child: IconButton(
                onPressed: () {
                  Get.back();
                },
                icon: const Icon(
                  Icons.arrow_back,
                  color: Colors.white,
                ),
              ),
            )
          ],
        ),
      ),
    );
  }
}

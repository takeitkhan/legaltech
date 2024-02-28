import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:user/helper/size_config.dart';

class CustomDialog extends StatelessWidget {
  const CustomDialog({
    Key? key,
    required this.imageUrl,
    required this.title,
    required this.description,
    required this.confirmText,
    required this.onPressed,
  }) : super(key: key);

  final String imageUrl;
  final String title;
  final String description;
  final String confirmText;
  final void Function() onPressed;

  @override
  Widget build(BuildContext context) {
    double height = SizeConfig.getHeight(context);
    double width = SizeConfig.getWidth(context);
    double fontSize(double size) {
      return size * width / 414;
    }

    return Dialog(
      elevation: 10,
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(10.0)),
      child: Container(
        padding: const EdgeInsets.symmetric(horizontal: 20.0, vertical: 12.0),
        height: height / 2.5,
        width: width / 1.5,
        decoration: BoxDecoration(
          color: const Color.fromARGB(255, 231, 229, 229),
          borderRadius: BorderRadius.circular(10.0),
        ),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Image(
              image: AssetImage(imageUrl),
              height: height / 15,
              width: width / 8,
            ),
            const SizedBox(height: 25.0),
            Text(
              title,
              style: TextStyle(
                fontSize: fontSize(24),
                color: const Color(0xFF5E5873),
                fontWeight: FontWeight.bold,
              ),
            ),
            const SizedBox(height: 15),
            Text(
              description,
              textAlign: TextAlign.center,
              style: TextStyle(
                fontSize: fontSize(16),
                color: const Color(0xFF5E5873),
              ),
            ),
            const SizedBox(height: 25.0),
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceEvenly,
              children: [
                ElevatedButton(
                  style: ElevatedButton.styleFrom(primary: Colors.grey),
                  onPressed: () {
                    Get.back();
                  },
                  child: Text(
                    'Cancel',
                    style: TextStyle(fontSize: fontSize(16)),
                  ),
                ),
                ElevatedButton(
                  style: ElevatedButton.styleFrom(
                      primary: const Color.fromARGB(255, 241, 37, 37)),
                  onPressed: onPressed,
                  child: Text(
                    confirmText,
                    style: TextStyle(fontSize: fontSize(16)),
                  ),
                )
              ],
            )
          ],
        ),
      ),
    );
  }
}

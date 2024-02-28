import 'package:flutter/material.dart';
import 'package:get/get.dart';

class Notifications extends StatelessWidget {
  const Notifications({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text(
          'Notification',
          style: TextStyle(color: Colors.black, fontWeight: FontWeight.bold),
        ),
        leading: IconButton(
          onPressed: () {
            Get.back();
          },
          icon: const Icon(
            Icons.arrow_back,
            color: Colors.black,
          ),
        ),
        centerTitle: true,
        backgroundColor: Colors.white,
        elevation: 0,
        actions: [
          IconButton(
            onPressed: () {},
            icon: const Icon(
              Icons.search,
              color: Colors.black,
            ),
          ),
        ],
      ),
      body: Padding(
        padding: const EdgeInsets.symmetric(horizontal: 15.0, vertical: 20),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          mainAxisAlignment: MainAxisAlignment.start,
          children: [
            const Text(
              'Today',
              style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold),
            ),
            ListTile(
              title: const Text(
                'Abdul Kalam',
                style: TextStyle(fontWeight: FontWeight.bold),
              ),
              subtitle: const Text(
                'We need high quality photo.This is not clear',
                style: TextStyle(fontSize: 12),
              ),
              trailing: Text(
                '08.40',
                style: TextStyle(
                    fontSize: 12, color: Theme.of(context).colorScheme.primary),
              ),
              leading: const CircleAvatar(
                radius: 20,
                backgroundImage: AssetImage('asset/user.jpg'),
              ),
            ),
            const SizedBox(height: 20),
            const Text(
              'Yesterday',
              style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold),
            ),
            ListTile(
              title: const Text(
                'Abdul Kalam',
                style: TextStyle(fontWeight: FontWeight.bold),
              ),
              subtitle: const Text(
                'We need high quality photo.This is not clear',
                style: TextStyle(fontSize: 12),
              ),
              trailing: Text(
                '08.40',
                style: TextStyle(
                    fontSize: 12, color: Theme.of(context).colorScheme.primary),
              ),
              leading: const CircleAvatar(
                radius: 20,
                backgroundImage: AssetImage('asset/user.jpg'),
              ),
            ),
          ],
        ),
      ),
    );
  }
}

import 'package:flutter/material.dart';
import 'package:flutter_hooks/flutter_hooks.dart';
import 'package:itr/views/screens/home/tabs/chat.dart';
import 'package:itr/views/screens/home/tabs/home.dart';
import 'package:itr/views/screens/home/tabs/notification.dart';
import 'package:itr/views/screens/home/tabs/packages.dart';
import 'package:itr/views/widgets/gradient_scaffold.dart';
import 'package:itr/views/widgets/home_navigation_bar.dart';

class HomeScreen extends HookWidget {
  HomeScreen({Key? key}) : super(key: key);

  final tabs = [
    const HomeTab(),
    const ChatTab(),
    const PackagesTab(),
    const NotificationTab(),
  ];

  @override
  Widget build(BuildContext context) {
    final activeTab = useState(0);

    return GradientScaffold(
      body: tabs[activeTab.value],
      bottomNavigationBar: HomeNavigationBar(
        onChange: (index) => activeTab.value = index,
      ),
    );
  }
}

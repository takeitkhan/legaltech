import 'package:flutter/material.dart';
import 'package:flutter_hooks/flutter_hooks.dart';
import 'package:hooks_riverpod/hooks_riverpod.dart';
import 'package:itr/core/services/local_storage.dart';
import 'package:itr/routes.dart';

class SplashScreen extends HookConsumerWidget {
  const SplashScreen({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    useEffect(() {
      Future.wait([
        ref.read(localStorageProvider).loadTokenAndUser(),
        Future.delayed(const Duration(seconds: 1)),
      ]).then((values) {
        if (values.first) {
          return Navigator.pushNamed(context, Routes.home);
        }
        return Navigator.pushNamed(context, Routes.welcome);
      });
      return null;
    }, []);

    return Scaffold(
      body: Image.asset(
        'assets/images/splash.jpg',
        width: double.infinity,
        height: double.infinity,
        fit: BoxFit.cover,
      ),
    );
  }
}

import 'package:flutter/material.dart';
import 'package:flutter_gen/gen_l10n/app_localizations.dart';
import 'package:hooks_riverpod/hooks_riverpod.dart';
import 'package:itr/routes.dart';
import 'package:itr/views/screens/splash.dart';

void main() {
  runApp(const ProviderScope(child: ITRApp()));
}

class ITRApp extends StatelessWidget {
  const ITRApp({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'Tax Media ITR',
      theme: ThemeData(
        colorScheme: const ColorScheme.light().copyWith(
          primary: const Color(0xFF7371FC),
          secondary: const Color(0xFFE2EBFF),
        ),
        inputDecorationTheme: InputDecorationTheme(
          filled: true,
          border: OutlineInputBorder(
            borderRadius: BorderRadius.circular(16),
          ),
          enabledBorder: OutlineInputBorder(
            borderSide: const BorderSide(
              color: Color(0x88ABAAFD),
            ),
            borderRadius: BorderRadius.circular(16),
          ),
          fillColor: const Color(0xFFE2EBFF),
        ),
        textTheme: const TextTheme(
          headline3: TextStyle(
            fontWeight: FontWeight.bold,
            color: Colors.black,
          ),
          headline6: TextStyle(
            fontSize: 16,
            fontWeight: FontWeight.w600,
          ),
          subtitle2: TextStyle(fontWeight: FontWeight.normal),
        ),
      ),
      onGenerateRoute: Routes.onGenerateRoute,
      onUnknownRoute: (settings) => MaterialPageRoute(
        builder: (context) => const SplashScreen(),
      ),
      localizationsDelegates: AppLocalizations.localizationsDelegates,
      supportedLocales: AppLocalizations.supportedLocales,
    );
  }
}

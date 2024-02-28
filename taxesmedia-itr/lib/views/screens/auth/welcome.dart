import 'package:flutter/material.dart';
import 'package:flutter_gen/gen_l10n/app_localizations.dart';
import 'package:itr/routes.dart';
import 'package:itr/views/widgets/primary_button.dart';

class WelcomeScreen extends StatelessWidget {
  const WelcomeScreen({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Container(
      decoration: const BoxDecoration(
        image: DecorationImage(
          image: AssetImage('assets/images/bg-gradient.jpg'),
          fit: BoxFit.cover,
        ),
      ),
      child: Scaffold(
        backgroundColor: Colors.transparent,
        body: SafeArea(
          child: Padding(
            padding: const EdgeInsets.all(16.0),
            child: Column(
              children: [
                const Spacer(),
                Text(
                  AppLocalizations.of(context)!.welcome_tax_media,
                  style: Theme.of(context).textTheme.headline3,
                ),
                const SizedBox(height: 12),
                Text(
                  AppLocalizations.of(context)!.welcome_subtitle,
                  style: Theme.of(context).textTheme.subtitle2,
                ),
                const SizedBox(height: 60),
                PrimaryButton(
                  onTap: () => Navigator.pushNamed(context, Routes.sendOtp),
                  text: AppLocalizations.of(context)!.continue_with_phone,
                ),
                Padding(
                  padding: const EdgeInsets.symmetric(vertical: 12),
                  child: Text(
                    AppLocalizations.of(context)!.or,
                    style: const TextStyle(color: Colors.grey),
                  ),
                ),
                PrimaryButton(
                  onTap: () {},
                  text: AppLocalizations.of(context)!.continue_as_guest,
                  backgroundColor: Colors.grey.shade600,
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}

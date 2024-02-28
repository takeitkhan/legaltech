import 'package:flutter/material.dart';
import 'package:flutter_gen/gen_l10n/app_localizations.dart';
import 'package:hooks_riverpod/hooks_riverpod.dart';
import 'package:itr/core/controllers/auth.dart';
import 'package:itr/routes.dart';
import 'package:itr/views/widgets/alert_dialog.dart';
import 'package:itr/views/widgets/gradient_scaffold.dart';
import 'package:itr/views/widgets/transparent_app_bar.dart';

class AccountScreen extends ConsumerWidget {
  const AccountScreen({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    return GradientScaffold(
      appBar: TransparentAppBar(title: AppLocalizations.of(context)!.account),
      body: SafeArea(
        child: ListView(
          padding: const EdgeInsets.all(16),
          children: [
            Center(
              child: Container(
                padding: const EdgeInsets.all(24),
                decoration: BoxDecoration(
                  color: Theme.of(context).colorScheme.primary,
                  borderRadius: BorderRadius.circular(25),
                ),
                child: Image.asset(
                  'assets/icons/person.png',
                  width: 45,
                  height: 45,
                  color: Colors.white,
                ),
              ),
            ),
            const SizedBox(height: 20),
            Text(
              'User Name',
              style: Theme.of(context).textTheme.headline6?.copyWith(
                    fontSize: 20,
                  ),
              textAlign: TextAlign.center,
            ),
            const SizedBox(height: 5),
            Text(
              'Profession',
              style: Theme.of(context).textTheme.titleSmall,
              textAlign: TextAlign.center,
            ),
            const SizedBox(height: 20),
            ListTile(
              title: Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  Image.asset(
                    'assets/icons/warning-info.png',
                    width: 20,
                  ),
                  const SizedBox(width: 10),
                  Text(
                    AppLocalizations.of(context)!.upgrade_package,
                    style: Theme.of(context).textTheme.bodyLarge?.copyWith(
                          color: Colors.white,
                        ),
                  ),
                ],
              ),
              tileColor: Colors.black87,
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(18),
              ),
              onTap: () {},
            ),
            const SizedBox(height: 16),
            buildTile(
              context,
              icon: Image.asset(
                'assets/icons/person.png',
                width: 22,
                height: 22,
              ),
              title: AppLocalizations.of(context)!.profile,
              onTap: () => Navigator.pushNamed(context, Routes.profile),
            ),
            const SizedBox(height: 16),
            buildTile(
              context,
              icon: Image.asset(
                'assets/icons/tag.png',
                width: 22,
                height: 22,
              ),
              title: AppLocalizations.of(context)!.purchase_details,
              onTap: () {},
            ),
            const SizedBox(height: 16),
            buildTile(
              context,
              icon: Image.asset(
                'assets/icons/info.png',
                width: 22,
                height: 22,
              ),
              title: AppLocalizations.of(context)!.tax_information,
              onTap: () {},
            ),
            const SizedBox(height: 16),
            buildTile(
              context,
              icon: Image.asset(
                'assets/icons/info.png',
                width: 22,
                height: 22,
              ),
              title: AppLocalizations.of(context)!.files,
              onTap: () {},
            ),
            const SizedBox(height: 16),
            buildTile(
              context,
              icon: Image.asset(
                'assets/icons/settings.png',
                width: 22,
                height: 22,
              ),
              title: AppLocalizations.of(context)!.language,
              onTap: () {},
            ),
            const SizedBox(height: 16),
            buildTile(
              context,
              icon: Image.asset(
                'assets/icons/support.png',
                width: 22,
                height: 22,
              ),
              title: AppLocalizations.of(context)!.help_n_support,
              onTap: () {},
            ),
            const SizedBox(height: 16),
            buildTile(
              context,
              icon: Image.asset(
                'assets/icons/logout.png',
                width: 22,
                height: 22,
              ),
              title: AppLocalizations.of(context)!.logout,
              onTap: () {
                showDialog(
                  context: context,
                  builder: (context) => ITRAlertDialog(
                    title: AppLocalizations.of(context)!.logout_dialog_title,
                    primaryAction: () {
                      ref.read(authControllerProvider).logout();
                      Navigator.pushNamedAndRemoveUntil(
                        context,
                        Routes.welcome,
                        (route) => false,
                      );
                    },
                  ),
                );
              },
            ),
          ],
        ),
      ),
    );
  }

  ListTile buildTile(
    BuildContext context, {
    required String title,
    required Widget icon,
    required void Function()? onTap,
  }) {
    return ListTile(
      leading: icon,
      title: Text(
        title,
        style: Theme.of(context).textTheme.bodyMedium?.copyWith(
              color: Colors.black87,
              fontWeight: FontWeight.w600,
            ),
      ),
      trailing: const Icon(
        Icons.arrow_forward,
        color: Colors.black87,
      ),
      minLeadingWidth: 24,
      tileColor: Theme.of(context).colorScheme.secondary,
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(18),
        side: BorderSide(
          color: Theme.of(context).colorScheme.primary.withOpacity(0.5),
          width: 0.3,
        ),
      ),
      onTap: onTap,
    );
  }
}

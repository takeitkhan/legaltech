import 'package:flutter/material.dart';
import 'package:flutter_gen/gen_l10n/app_localizations.dart';
import 'package:itr/views/widgets/gradient_scaffold.dart';
import 'package:itr/views/widgets/transparent_app_bar.dart';

class NotificationTab extends StatelessWidget {
  const NotificationTab({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return GradientScaffold(
      appBar: TransparentAppBar(
        showDefaultLeading: false,
        title: AppLocalizations.of(context)!.notification,
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: ListView(
          children: [
            Text(
              AppLocalizations.of(context)!.new_notifications,
              style: Theme.of(context).textTheme.headline6,
            ),
            const SizedBox(height: 20),
            ListTile(
              leading: Container(
                width: 50,
                height: 50,
                decoration: BoxDecoration(
                  color: Theme.of(context).colorScheme.primary,
                  shape: BoxShape.circle,
                ),
                child: Center(
                  child: Image.asset(
                    'assets/icons/notification.png',
                    width: 25,
                  ),
                ),
              ),
              title: Text(
                AppLocalizations.of(context)!.order_confirmed_notification,
                style: Theme.of(context).textTheme.titleLarge,
              ),
            ),
          ],
        ),
      ),
    );
  }
}

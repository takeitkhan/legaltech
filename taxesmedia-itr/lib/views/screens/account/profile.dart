import 'package:flutter/material.dart';
import 'package:flutter_gen/gen_l10n/app_localizations.dart';
import 'package:flutter_hooks/flutter_hooks.dart';
import 'package:itr/views/widgets/gradient_scaffold.dart';
import 'package:itr/views/widgets/primary_button.dart';
import 'package:itr/views/widgets/transparent_app_bar.dart';

class ProfileScreen extends HookWidget {
  const ProfileScreen({
    Key? key,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    final formKey = GlobalKey<FormState>();
    final name = useTextEditingController();
    final mobile = useTextEditingController();
    final occupation = useTextEditingController();

    return GradientScaffold(
      appBar: TransparentAppBar(
        title: AppLocalizations.of(context)!.profile,
      ),
      body: SafeArea(
        child: Padding(
          padding: const EdgeInsets.all(16.0),
          child: Form(
            key: formKey,
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  AppLocalizations.of(context)!.name,
                  style: Theme.of(context).textTheme.titleLarge,
                ),
                const SizedBox(height: 8),
                TextField(
                  controller: name,
                  onEditingComplete: () => FocusScope.of(context).nextFocus(),
                ),
                const SizedBox(height: 12),
                Text(
                  AppLocalizations.of(context)!.mobile,
                  style: Theme.of(context).textTheme.titleLarge,
                ),
                const SizedBox(height: 8),
                TextField(
                  controller: mobile,
                  keyboardType: TextInputType.number,
                  onEditingComplete: () => FocusScope.of(context).nextFocus(),
                ),
                const SizedBox(height: 12),
                Text(
                  AppLocalizations.of(context)!.occupation,
                  style: Theme.of(context).textTheme.titleLarge,
                ),
                const SizedBox(height: 8),
                TextField(
                  controller: occupation,
                  onEditingComplete: () => FocusScope.of(context).nextFocus(),
                ),
                const SizedBox(height: 20),
                const Spacer(),
                PrimaryButton(
                  onTap: () {
                    if (formKey.currentState?.validate() ?? false) {}
                  },
                  text: AppLocalizations.of(context)!.save,
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
